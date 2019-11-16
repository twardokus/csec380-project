We prevent XSS when displaying the username of a user by sanitizing username displays.

we ensure users can't delete videos that aren't theirs by checking php session username against the uploader.