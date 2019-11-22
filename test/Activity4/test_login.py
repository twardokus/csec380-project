# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests
import time

s = requests.Session()


def login(username, password):
    url = "http://localhost/loginvalidate.php"
    validCreds = {'username': username, 'password': password}
    result = s.post(url, validCreds, allow_redirects=True)

    return result


def test_login():
    while "mysqli_connect" in login('notarealuser', 'badpassword').text:
        time.sleep(1)
    # Test valid credentials

    loginResponse = login('admin@rit.edu', 'password')

    assert (loginResponse.status_code == 200)
    print(loginResponse.text)
    assert (
            "(Cookies in use)" not in loginResponse.text and '<meta http-equiv="Refresh" content="0" '
                                                             'url="http://localhost/login.php" />' not in
            loginResponse.text)


# Test bad username and good password


def wait_for_docker_compose():
    failures = 0
    while failures < 10:
        try:
            home = requests.get("http://localhost", allow_redirects=True)
            break
        except:
            failures += 1
            time.sleep(30)


def test_connection():
    home = s.get("http://127.0.0.1:80", allow_redirects=True)
    assert (home != None)


wait_for_docker_compose()
test_connection()
test_login()
