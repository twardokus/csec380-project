&bull; Link to test here: \test\test_login.py

&bull; By first using PHP to ensure that non-authenticated users are redirected to the login page, and are unable to view protected pages, we protect those pages. Then by keeping any backend pages restricted with parameters being generated from the backend, we ensure that users cannot spoof information to bypass our controls. 

&bull; We protect against session fixation by not using local cookies. We use PHP sessions, which are stored on server side.

&bull; We ensure passwords aren't exposed if that database is stolen by hashing them.

&bull; To prevent brute force we have implemented a reCAPTCHA.

&bull; To prevent username enumeration, we do not reveal whether it was the password or the username that was incorrect.

&bull; If your sessionID is predictable, attackers can use a predicted session token to bypass authentication. To prevent this we use randomly generated php session tokens.
