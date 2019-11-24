# Basic unit test for the Hello World webpage

import requests
import time

"""
Test video upload via file
"""
def test_uploadvid():
    url = 'http://localhost/phpinfo.php'
    result = requests.post(url)
    print(result.text)
    urltwo = 'http://localhost/travistest.php'
    resulttwo = requests.post(urltwo)
    print(resulttwo.text)


"""
Utility function to delay test execution until docker-compose has brought all container online.
"""
def wait_for_docker_compose():
    failures = 0
    while failures < 10:
        try:
            home = requests.get("http://localhost", allow_redirects=True)
            break
        except:
            failures += 1
            time.sleep(30)

"""
Test whether the web server is online
"""
def test_connection():
    home = s.get("http://127.0.0.1:80", allow_redirects=True)
    assert (home != None)



"""
Execute test sequence
"""
wait_for_docker_compose()
test_connection()
test_uploadvid()
