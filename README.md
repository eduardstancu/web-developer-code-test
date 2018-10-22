I put the test also on one of my domains:

http://smartpeople.club/a999/

The index.php file read the test_data.json decode the info and create a series of forms
that are identified by the id.

Each form have the possibility to associate an image file to the id.
After choosing the image you can save the image file in a folder img that exist in the server by pressing the Save button.
The operation use JQuery Ajax and PHP.
In the same time all the info are saved in the MySQLi database using ajax and JavaScript (the id, description and the path to the file).

Before saving the data we call a method verifyDataSaved($id) from the class DataOperation to verify if the data was not already saved.
If it was, we will update the table with the new image path, with the method updateData($id, $imgpath).
If it is the first time we save this data we will use the method saveData($id, $description, $imgpath)

The button "Clear all Data in Database" clear the table data using the method clearData()

The button "Show all Data in Database" show all the record saved in the table.

In tmp folder I put some images that can be used to test the model.



