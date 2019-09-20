# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests

page = requests.get("http://localhost/")

content = page.content

soup = BeautifulSoup(content)

target = soup.find_all("p")

assert(target[0].contents == "Hello World")