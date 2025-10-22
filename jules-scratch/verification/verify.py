from playwright.sync_api import sync_playwright
import os

with sync_playwright() as p:
    browser = p.chromium.launch()
    page = browser.new_page()
    # Get the absolute path to the index.html file
    index_path = os.path.abspath('index.html')
    page.goto(f"file://{index_path}")
    page.screenshot(path="jules-scratch/verification/screenshot.png")
    browser.close()
