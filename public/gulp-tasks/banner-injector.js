"use strict";

const { Transform } = require("stream");

const COPYRIGHT_START_YEAR = 2013;
const FALLBACK_TITLE = "Start Bootstrap";
const FALLBACK_HOMEPAGE = "https://startbootstrap.com/theme/sb-admin-2";
const FALLBACK_AUTHOR = "Start Bootstrap";
const FALLBACK_LICENSE = "UNLICENSED";
const LICENSE_PATH = "/blob/master/LICENSE";

// Guard rails for everything coming out of gulp tasks.  These helpers
// intentionally never execute template strings or interpolated user data
// in a way that could trigger lodash.template.  We only ever concatenate
// deterministic strings so that the header injection surface is as small
// and predictable as possible on the surgical console.

function sanitizeString(value, fallback) {
    if (typeof value !== "string") {
        return fallback;
    }

    const trimmed = value.trim();
    return trimmed.length ? trimmed : fallback;
}

function resolveAuthor(author) {
    if (!author) {
        return FALLBACK_AUTHOR;
    }

    if (typeof author === "string") {
        return sanitizeString(author, FALLBACK_AUTHOR);
    }

    if (Array.isArray(author) && author.length) {
        return resolveAuthor(author[0]);
    }

    if (typeof author === "object" && author.name) {
        return sanitizeString(author.name, FALLBACK_AUTHOR);
    }

    return FALLBACK_AUTHOR;
}

function normalizeHomepage(pkg) {
    if (pkg && pkg.homepage) {
        return sanitizeString(pkg.homepage, FALLBACK_HOMEPAGE).replace(/\/+$/, "");
    }

    if (pkg && pkg.repository) {
        const repo = typeof pkg.repository === "string" ? pkg.repository : pkg.repository.url;
        if (repo) {
            const cleaned = sanitizeString(repo.replace(/^git\+/, ""), FALLBACK_HOMEPAGE)
                .replace(/\.git$/, "")
                .replace(/\/+$/, "");
            return cleaned || FALLBACK_HOMEPAGE;
        }
    }

    return FALLBACK_HOMEPAGE;
}

function buildBanner(pkg) {
    const title = sanitizeString(pkg.title || pkg.name, FALLBACK_TITLE);
    const version = sanitizeString(pkg.version, "0.0.0");
    const homepage = normalizeHomepage(pkg);
    const author = resolveAuthor(pkg.author);
    const license = sanitizeString(pkg.license, FALLBACK_LICENSE);
    const licenseUrl = `${homepage}${LICENSE_PATH}`;
    const yearRange = `${COPYRIGHT_START_YEAR}-${new Date().getFullYear()}`;

    return [
        "/*!\n",
        ` * Start Bootstrap - ${title} v${version} (${homepage})\n`,
        ` * Copyright ${yearRange} ${author}\n`,
        ` * Licensed under ${license} (${licenseUrl})\n`,
        " */\n",
        "\n"
    ].join("");
}

function prependBanner(text) {
    const bannerBuffer = Buffer.from(text);

    return new Transform({
        objectMode: true,
        transform(file, _, callback) {
            if (!file || (typeof file.isNull === "function" && file.isNull())) {
                callback(null, file);
                return;
            }

            if (typeof file.isBuffer === "function" && file.isBuffer()) {
                file.contents = Buffer.concat([bannerBuffer, file.contents]);
                callback(null, file);
                return;
            }

            if (typeof file.isStream === "function" && file.isStream()) {
                const chunks = [];
                let cleanup;

                const onData = (chunk) => {
                    chunks.push(Buffer.isBuffer(chunk) ? chunk : Buffer.from(chunk));
                };

                const onEnd = () => {
                    cleanup();
                    const body = chunks.length ? Buffer.concat(chunks) : Buffer.alloc(0);
                    file.contents = Buffer.concat([bannerBuffer, body]);
                    callback(null, file);
                };

                const onError = (err) => {
                    cleanup();
                    callback(err);
                };

                cleanup = () => {
                    file.contents.removeListener("data", onData);
                    file.contents.removeListener("end", onEnd);
                    file.contents.removeListener("error", onError);
                };

                file.contents.on("data", onData);
                file.contents.once("end", onEnd);
                file.contents.once("error", onError);

                if (typeof file.contents.resume === "function") {
                    file.contents.resume();
                }

                return;
            }

            callback(null, file);
        }
    });
}

module.exports = {
    buildBanner,
    prependBanner
};
