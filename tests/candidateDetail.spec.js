// @ts-check
import { test, expect } from '@playwright/test';

test.describe('Candidate Detail Page', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('http://mercadotrabajo.localdev:8080/dashboard/company/candidate-detail/8');
  });

  test('should display the candidate detail page with correct styling', async ({ page }) => {
    // Verify the page loads
    await expect(page.locator('body')).toBeVisible();

    // Check for specific elements with bg-blue2-100 class
    const blueElement = page.locator('.bg-blue2-100').first();
    await expect(blueElement).toBeVisible();
    await expect(blueElement).toHaveCSS('background-color', 'rgb(227, 235, 250)');

    // Verify candidate information is displayed
    await expect(page.locator('.candidate-block-five')).toBeVisible();
    await expect(page.locator('.candidate-info')).toBeVisible();
    await expect(page.locator('.job-detail > h2')).toBeVisible();

    // Verify sections exist
    // await expect(page.locator('.education-section')).toBeVisible();
    // await expect(page.locator('.experience-section')).toBeVisible();
    // await expect(page.locator('.skills-section')).toBeVisible();
  });
});