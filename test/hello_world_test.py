# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup

page = requests.get("http://localhost/index.php")

content = page.content

soup = BeautifulSoup(content)

target = soup.find_all("h1")

assert(target[0].contents == "Hello World")