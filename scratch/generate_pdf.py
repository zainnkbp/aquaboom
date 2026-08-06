import markdown
import subprocess
import os

with open("Panduan_Penggunaan_Aquaboom.md", "r", encoding="utf-8") as f:
    text = f.read()

html = markdown.markdown(text)

html_template = f"""
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body {{
    font-family: Arial, sans-serif;
    margin: 40px;
    line-height: 1.6;
    color: #333;
}}
h1, h2, h3 {{
    color: #111;
}}
img {{
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin: 20px 0;
}}
code {{
    background-color: #f4f4f4;
    padding: 2px 4px;
    border-radius: 4px;
}}
</style>
</head>
<body>
{html}
</body>
</html>
"""

with open("scratch/panduan.html", "w", encoding="utf-8") as f:
    f.write(html_template)

# Use Chrome to print to PDF
chrome_path = "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome"
pdf_path = os.path.abspath("Panduan_Penggunaan_Aquaboom.pdf")
html_path = os.path.abspath("scratch/panduan.html")

subprocess.run([
    chrome_path,
    "--headless",
    "--disable-gpu",
    "--print-to-pdf=" + pdf_path,
    "--no-pdf-header-footer",
    "file://" + html_path
], check=True)

print("PDF successfully generated at:", pdf_path)
