# UOI Restaurant

Simple project to view the menu for the restaurant of the university of Ioannina.

## How to use

### python version

The python version is complete and can be used to read the current month's menu. All you have to do is run the following commands:
- python -m pip install -r requirements.txt
	required to download the packages that are required for the project to run
- python restaurant.py
	to actually run the program. This program has only 3 lines of code. You can use the function `get_file_from_url(get_current_menu())` to get a dictionary with the entire menu.The function `get_current_menu()` returns the url of the current menu and the function `get_file_from_url()` parses the docx to generate the menu from the url

### PHP version

The php version is not ready yet, however it is much easier to use as it is actually being hosted in my university student account. Therefore, all you need to do is make an http request to the url: `[https://www.cse.uoi.gr/~cse74134/restaurant/index.php](https://www.cse.uoi.gr/~cse74134/restaurant/index.php)`

## How is it working

It actually reads the page [https://www.uoi.gr/tag/menou-lesxis/](https://www.uoi.gr/tag/menou-lesxis/) which contains all the data for the menu per month. Then it reads the links there and parses the content, keeping all the documents, and finally, it prints the desired document links to the client.


## Where can I find the code running?

The code is running in the school server right here: [https://cse.uoi.gr/~cse74134/restaurant/](https://cse.uoi.gr/~cse74134/restaurant/)

## TODO:
 - Add the posibility to read all the links or just the latest one.
 - Make a function that parses the doc to a json array
