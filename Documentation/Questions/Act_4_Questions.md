&bull; We prevent XSS when displaying the username of a user by sanitizing username displays.

&bull; First, our code only displays the delete video button for videos uploaded by the currently logged in user. <br><br>
Second, when trying to delete a file, the uploader of the file indended to be deleted is checked against the currently logged in user to make sure that they match. Becuase we are doing both of those comparisons on the backend, using information from the backend, there is no potential for a user to be able to delete someone elses videos. 
