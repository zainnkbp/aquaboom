const puppeteer = require('puppeteer');

(async () => {
    try {
        const browser = await puppeteer.launch({ headless: 'new' });
        const page = await browser.newPage();
        await page.setViewport({ width: 1280, height: 800 });

        // Screenshot 1: Checkout Form / Web
        console.log('Taking screenshot of main page...');
        await page.goto('http://localhost:8000/', { waitUntil: 'networkidle2' });
        await page.screenshot({ path: 'assets/docs/home.png' });

        // Screenshot 2: Admin Login
        console.log('Taking screenshot of admin login...');
        await page.goto('http://localhost:8000/admin/login', { waitUntil: 'networkidle2' });
        await page.screenshot({ path: 'assets/docs/admin_login.png' });

        // Screenshot 3: Scanner Login
        console.log('Taking screenshot of scanner login...');
        await page.goto('http://localhost:8000/scanner/login', { waitUntil: 'networkidle2' });
        await page.screenshot({ path: 'assets/docs/scanner_login.png' });

        await browser.close();
        console.log('Done!');
    } catch (e) {
        console.error(e);
        process.exit(1);
    }
})();
