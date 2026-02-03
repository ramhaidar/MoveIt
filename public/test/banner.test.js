"use strict";

const assert = require("assert");
const { Readable } = require("stream");
const { buildBanner, prependBanner } = require("../gulp-tasks/banner-injector");

function makeVinyl(contents) {
    return {
        contents,
        isBuffer() {
            return Buffer.isBuffer(this.contents);
        },
        isStream() {
            return Boolean(this.contents && typeof this.contents.on === "function");
        },
        isNull() {
            return this.contents === null;
        }
    };
}

function runThroughTransform(transform, file) {
    return new Promise((resolve, reject) => {
        transform.once("error", reject);
        transform.once("data", resolve);
        transform.write(file);
        transform.end();
    });
}

async function runBannerTests() {
    const samplePkg = {
        title: "SB Admin 2",
        version: "4.1.3",
        homepage: "https://startbootstrap.com/theme/sb-admin-2",
        license: "MIT",
        author: "Start Bootstrap"
    };

    const banner = buildBanner(samplePkg);
    const currentYear = new Date().getFullYear();

    assert(banner.includes(samplePkg.title), "banner should mention the project title");
    assert(banner.includes(`v${samplePkg.version}`), "banner should include the current version");
    assert(banner.includes(samplePkg.homepage), "banner should embed the homepage");
    assert(banner.includes("MIT"), "banner should advertise the license");
    assert(banner.includes(`2013-${currentYear}`), "banner should include the current year range");

    const bufferFile = makeVinyl(Buffer.from("ORIGINAL"));
    const bufferResult = await runThroughTransform(prependBanner(banner), bufferFile);
    const bufferPayload = bufferResult.contents.toString();
    assert(bufferPayload.startsWith(banner), "buffer path must prefix files");
    assert(bufferPayload.includes("ORIGINAL"), "buffer path must preserve payload");

    const nullFile = makeVinyl(null);
    const nullResult = await runThroughTransform(prependBanner(banner), nullFile);
    assert.strictEqual(nullResult.contents, null, "null files must transit unchanged");

    const streamFile = makeVinyl(Readable.from(["STREAM"], { objectMode: false }));
    const streamResult = await runThroughTransform(prependBanner(banner), streamFile);
    const streamPayload = streamResult.contents.toString();
    assert(streamPayload.startsWith(banner), "stream path must prefix files");
    assert(streamPayload.endsWith("STREAM"), "stream path must preserve streamed data");

    const fallbackBanner = buildBanner({});
    assert(fallbackBanner.includes("Start Bootstrap"), "fallback metadata must retain recognizable author");
    assert(fallbackBanner.includes("UNLICENSED"), "fallback metadata must not crash when license is missing");

    console.log("banner-injector tests passed");
}

runBannerTests().catch((err) => {
    console.error(err);
    process.exitCode = 1;
});
