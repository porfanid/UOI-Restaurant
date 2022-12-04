from datetime import datetime
currentMonth = datetime.now().month
from webpage import get_current_menu
from docx_functions import get_file_from_url
print(get_file_from_url(get_current_menu()))
