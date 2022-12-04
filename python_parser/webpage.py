from bs4 import BeautifulSoup
import urllib

from datetime import datetime
currentMonth = datetime.now().month

def read_links_from_url(link, constraint, in_href):
	f = urllib.request.urlopen(link)
	myfile = f.read()
	soup = BeautifulSoup(myfile, 'html.parser')
	links = soup.find_all('a')
	if constraint is None:
		return [link.get('href') for link in links]
	if in_href:
		return [link.get('href') for link in links if constraint in link.get('href')]
	else:
		return [link.get('href') for link in links if constraint in link.text.lower()]
	
def get_all_menus():
	links_for_restaurant_per_month = read_links_from_url("https://www.uoi.gr/tag/menou-lesxis/", "πρόγραμμα σίτισης", False)
	menu = []
	for link in links_for_restaurant_per_month :
		menu_docs = read_links_from_url(link, "doc", True);
		menu += menu_docs;
	
	return menu;

def get_month():
	global currentMonth
	months = ['ianouar', 'fevroy', 'mart', 'april', 'mai', 'ioyni', 'ioyli','aug', 'septemv', 'okto', 'noem', 'dekem']
	return months[currentMonth-1];


def get_current_menu():
	all_menus = get_all_menus();
	month = get_month();
	for menu in all_menus:
		if month in menu:
			return menu;
	return False;
