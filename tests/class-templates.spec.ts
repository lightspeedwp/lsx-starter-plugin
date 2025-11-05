import { test, expect } from '@playwright/test';

test.describe('LSX Starter Plugin - Templates', () => {
  test('Archive template contains <main>', async ({ page }) => {
    await page.goto('http://localhost/wp-content/plugins/lsx-starter-plugin/templates/archive-post-type.html');
    const main = await page.locator('main');
    await expect(main).toHaveCount(1);
  });

  test('Single template contains <main>', async ({ page }) => {
    await page.goto('http://localhost/wp-content/plugins/lsx-starter-plugin/templates/single-post-type.html');
    const main = await page.locator('main');
    await expect(main).toHaveCount(1);
  });
});