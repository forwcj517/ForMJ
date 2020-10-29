import os
import sys
import linecache
import shutil
import time
import mysql.connector
import config

from datetime import datetime

try: #python3
    import urllib
    from urllib.request import urlopen
    from urllib.parse import urlparse
except: #python2
    from urllib2 import urlopen


def print_exception():
    exc_type, exc_obj, tb = sys.exc_info()
    f = tb.tb_frame
    lineno = tb.tb_lineno
    filename = f.f_code.co_filename
    linecache.checkcache(filename)
    line = linecache.getline(filename, lineno, f.f_globals)
    
    text = "{}: EXCEPTION IN ({}, LINE {} '{}'): {}\r\n".format(datetime.today().strftime('%Y-%m-%d %H:%M:%S'), filename, lineno, line.strip(), exc_obj)
    print(text)

    # log content to text file
    if not os.path.exists('logs/image-moving'):
        os.makedirs('logs/image-moving')
    f = open("logs/image-moving/{}.txt".format(datetime.today().strftime('%Y-%m-%d')), "a")
    f.write(text)
    f.close()


def download_file(dir_path, link):
    img_file_name = os.path.basename(urlparse(link).path)
    dir_path = '\\'.join(dir_path.split('/'))
    img_dir_path = dir_path + "\{0}".format(img_file_name)

    if not os.path.exists(dir_path):
        try:
            os.makedirs(dir_path)
        except Exception as e:
            print_exception()

    if os.path.exists(img_dir_path):
        print("Already exists...")
    else:
        print("downloading: " + link)
        try:
            urllib.request.urlretrieve(link, img_dir_path)
        except Exception as e:
            print_exception()


try:
    db = mysql.connector.connect(**config.mysql)
    cur = db.cursor(buffered=True, dictionary=True)
    stmt = "SELECT * FROM images;"
    cur.execute(stmt)
    total_items = cur.fetchall()
    cur.close()
    db.close()

    for item in total_items:
        image_path = item['path']
        download_file("FlaskWeb" + os.path.dirname(image_path), 'http://18.176.61.234' + image_path)
except Exception as e:
    print_exception()


