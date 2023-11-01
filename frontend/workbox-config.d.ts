declare module '../workbox-config.js' {
    const workboxConfig: {
        globDirectory: string;
        globPatterns: string[];
        swDest: string;
    };
    export default workboxConfig;
}
