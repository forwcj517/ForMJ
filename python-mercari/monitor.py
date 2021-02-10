# coding: utf-8

import os
from os.path import isfile

os.environ["HTTP_PROXY"] = ""
os.environ["HTTPS_PROXY"] = ""
os.environ['TZ'] = 'Asia/Tokyo'

import sys
import linecache

import mysql.connector
import config

import subprocess
from operator import itemgetter
import shutil

from tensorflow import keras
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import img_to_array, load_img

import PIL
from PIL import Image

import matplotlib.pyplot as plt
import numpy as np
from numpy import random

from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options

from datetime import datetime

import time
from timeit import default_timer as timer

try: #python3
    import urllib
    from urllib.request import urlopen
    from urllib.parse import urlparse
except: #python2
    from urllib2 import urlopen

import json
json_dec = json.JSONDecoder()

def get_labels(model_name):
    label_file = os.path.join('labels', model_name + '.labels')
    json_label = json_dec.decode(open(label_file, 'r').read())

    labels = []
    for strLabel in json_label['vector']:
        labels.append(int(strLabel))

    return labels


def get_types(model_name):
    watch_type_file = os.path.join('types', model_name + '.types')
    json_watch_models = json_dec.decode(open(watch_type_file, 'r', encoding="utf8").read())

    return json_watch_models


def replace_strange_strings(str):
    mapping = {
        'Ａ':'A',
        'Ｂ':'B',
        'Ｃ':'C',
        'Ｄ':'D',
        'Ｅ':'E',
        'Ｆ':'F',
        'Ｇ':'G',
        'Ｈ':'H',
        'Ｉ':'I',
        'Ｊ':'L',
        'Ｋ':'K',
        'Ｌ':'L',
        'Ｍ':'M',
        'Ｎ':'N',
        'Ｏ':'O',
        'Ｐ':'P',
        'Ｑ':'Q',
        'Ｒ':'R',
        'Ｓ':'S',
        'Ｔ':'T',
        'Ｕ':'U',
        'Ｖ':'V',
        'Ｗ':'W',
        'Ｘ':'X',
        'Ｙ':'Y',
        'Ｚ':'Z',
        'ａ':'a',
        'ｂ':'b',
        'ｃ':'c',
        'ｄ':'d',
        'ｅ':'e',
        'ｆ':'f',
        'ｇ':'g',
        'ｈ':'h',
        'ｉ':'i',
        'ｊ':'j',
        'ｋ':'k',
        'ｌ':'l',
        'ｍ':'m',
        'ｎ':'n',
        'ｏ':'o',
        'ｐ':'p',
        'ｑ':'q',
        'ｒ':'r',
        'ｓ':'s',
        'ｔ':'t',
        'ｕ':'u',
        'ｖ':'v',
        'ｗ':'w',
        'ｘ':'x',
        'ｙ':'y',
        'ｚ':'z',
        '１':'1',
        '２':'2',
        '３':'3',
        '４':'4',
        '５':'5',
        '６':'6',
        '７':'7',
        '８':'8',
        '９':'9',
        '０':'0',
        '－':'-',
        '　':'',
        ' ': ''}
    for k, v in mapping.items():
        str = str.replace(k, v)
    
    return str


# 英語サイト用
#mercariSettings = {'itemClass': 'Flex__Box-ych44r-1', 'nameTagClass': 'withMetaInfo__EllipsisText-sc-1j2k5ln-12', 'priceTagClass': 'withMetaInfo__ProductPrice3-sc-1j2k5ln-5', 'originalPriceTagClass': 'withMetaInfo__OriginalPrice-sc-1j2k5ln-11', 'discountPriceTagClass': 'withMetaInfo__DiscountPrice-sc-1j2k5ln-9'}
#aBrandWatch = {7763:"breitling", 1037:"burgali", 2916:"hermes", 8708:"hermes", 4727:"omega", 4728:"omega", 4729:"omega", 7225:"rolex",\
#               9999:"other"}

# 日本語サイト用
mercariSettings = {'itemClass': 'items-box', 'nameTagClass': 'items-box-name', 'priceTagClass': 'items-box-price'}
aBrandWatch = {1510:"omega", 1976:"rolex", 365:"hermes", 1816:"breitling", 1069:"bvlgari"}

#aBrandWatch = {1510:"omega"}

models = {}
for model_id in aBrandWatch:
    models[model_id] = keras.models.load_model(os.path.join('models', aBrandWatch[model_id] + '.h5'))


predefined_types = {}
for model_id in aBrandWatch:
    predefined_types[model_id] = get_types(aBrandWatch[model_id])


stop_words = [
    '保証書',
    'パーペチュアル',
    'PERPETUAL',
    '説明書',
    '冊子',
    '冊セット',
    'MANUAL',
    'カタログ',
    'CATALOG',
    'カレンダーカード',
    '不動',
    '不動品',
    '電池なし',
    '箱',
    '箱のみ',
    'ボックス',
    'BOX',
    'ケース',
    '保存ケース',
    '時計ケース',
    '空箱',
    '部品',
    'パーツ',
    'ゼンマイ',
    'クリップ',
    'タグ',
    'テンプ',
    'ガラス風防',
    'ダイヤル',
    '文字盤',
    'クラウン',
    'PG',
    '車',
    'ムーブメント',
    'ヒゲ',
    'ねじ',
    'ネジ',
    '尾錠',
    '尾帖',
    'ブレスレット',
    '調整金具',
    'バンド',
    'ベルト',
    '付替ベルト',
    'ベルト交換',
    'ベルト 交換',
    'ベルト　交換',
    'コマ',
    '駒',
    'こま',
    'ジャンク',
    '付属品のみ',
    'クリーナー',
    '保存袋',
    '紙袋',
    '包装紙',
    'ショップ袋',
    'ショッパー',
    'カバ',
    '入れ',
    '時計入れ',
    'カード入れ',
    'スプーン',
    'コップ',
    'CUP',
    'ペン',
    'PEN',
    'セット',
    '個',
    '専用']


def parse_clock_item(plain):
    contents = plain.split(',')
    if len(contents) < 7 or len(contents) > 7:
        return None
    item = dict()
    item['label']    = int(contents[0])
    item['category'] = contents[1]
    item['brand']    = contents[2]
    item['type']     = contents[3]
    item['model']    = contents[4]
    item['price']    = contents[5]
    item['photo']    = contents[6]
    
    numbers = []
    number_items = contents[6].split(';')
    for number in number_items:
        idx = number.find('-')
        if idx < 0:
            numbers.append(int(number))
        else:
            first = int(number[:idx])
            last = int(number[idx+1:])
            for i in range(first, last+1):
                numbers.append(i)
    item['numbers'] = numbers
    return item


def get_clock_items():
    lines = open('clock.csv', 'r', encoding='utf-8').read().split('\n')
    
    clock_items = []
    for line in lines:
        clock_item = parse_clock_item(line)
        if clock_item != None:
            clock_items.append(clock_item)
    
    return clock_items


def get_item_for_label(label):
    for clock_item in clock_items:
        if label == clock_item['label']:
            return clock_item
    return None


def get_item_by_name(model, type):
    for clock_item in clock_items:
        if model == clock_item['model'] and type == clock_item['type']:
            return clock_item

    # if whole matching is not successful
    for clock_item in clock_items:
        if model == clock_item['model'] and (clock_item['type'].find(type) > -1 or type.find(clock_item['type']) > -1):
            return clock_item
    return None


def predict_img_with_model(model, img):
    probs = model.predict_on_batch(img)
    idx = np.argmax(probs)
    prob = probs[0][idx]
    
    return idx, prob


def predict_item(market, item, cnx):
    log_text = "predicting..."
    write_log(log_text)

    try:
        image_width = 224
        image_height = 224

        brand = item['brand']
        if brand in aBrandWatch:
            brand_name = aBrandWatch[brand]
        else:
            brand_name = aBrandWatch[9999]

        model = models[brand]
        labels = get_labels(brand_name)

        img_dir_path = "FlaskWeb\images\{0}\{1}\{2}".format(market, brand, item['item_id'])
        
        # max number is 1994
        result_labels = np.zeros(2000)
        result_probs  = np.zeros(2000)
        
        total_time = 0

        for file in item['images']:
            time_per_image = 0
            img_path = os.path.join(img_dir_path, file['filename'])

            if not os.path.exists(img_path):
                continue

            start = timer()
            
            img = Image.open(img_path)
            img = img.resize((224, 224))
            p_img = img
            img = np.array(img)
            
            img = keras.applications.mobilenet.preprocess_input(img)
            img = np.expand_dims(img, 0)

            probs = model.predict_on_batch(img)
            max_idx = np.argmax(probs)
            prob = probs[0][max_idx]
            label_pred = int(labels[max_idx])
            clockItem_pred = get_item_for_label(label_pred)
            
            result_labels[label_pred] = result_labels[label_pred] + 1
            result_probs[label_pred] = result_probs[label_pred] + prob

            if clockItem_pred is not None:
                text = 'Photo: %s,\nNo: %d,\nProb: %.4f\nBrand: %s\nSerial Number: %s, Model %s: \n Price: %s' % (clockItem_pred['photo'], label_pred, prob,
                                                                                              clockItem_pred['brand'],
                                                                                              clockItem_pred['type'],  clockItem_pred['model'],
                                                                                              clockItem_pred['price'])
                #print(text)
            
            end = timer()
            
            total_time = total_time + end - start
            
            insert_image_db(cnx, market, brand, item, file, clockItem_pred, prob, end-start)
            
        return {'labels': result_labels, 'probs': result_probs}

    except Exception as e:
        print_exception()


def print_exception():
    exc_type, exc_obj, tb = sys.exc_info()
    f = tb.tb_frame
    lineno = tb.tb_lineno
    filename = f.f_code.co_filename
    linecache.checkcache(filename)
    line = linecache.getline(filename, lineno, f.f_globals)
    
    text = "EXCEPTION IN ({}, LINE {} '{}'): {}".format(filename, lineno, line.strip(), exc_obj)
    write_log(text)


# log content to text file
def write_log(text):
    print(text)
    
    if not os.path.exists('logs/monitor'):
        os.makedirs('logs/monitor')
    f = open("logs/monitor/{}.txt".format(datetime.today().strftime('%Y-%m-%d')), "a")
    f.write("{0}: {1}\r\n".format(datetime.today().strftime('%Y-%m-%d %H:%M:%S'), text))
    f.close()


def insert_item_db(cnx, item, market, brand, bid_flg):
    cur = cnx.cursor()

    try:
        log_text = "Inserting watch into DB"
        write_log(log_text)
        
        stmt = "INSERT INTO items (item_id, link, title, price, likes, brand, brand_name, seller_name, seller_link, status, shipping_charge, shipping_origin, shipping_date, detail, purchased, market_id, created_at) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())" 
        cur.execute(stmt, [item['item_id'], item['link'], item['title'], item['price'], item['likes'], brand, aBrandWatch[brand], item['seller_name'], item['seller_link'], item['status'], item['shipping_charge'], item['shipping_origin'], item['shipping_date'], item['detail'], "{}".format(bid_flg), market])
        cnx.commit()
        
        log_text = "Inserting watch into DB success"
        write_log(log_text)
    except:
        cnx.rollback()
        print_exception()
        
        log_text = "Inserting watch into DB failed"
        write_log(log_text)
        raise

    cur.close()


def insert_image_db(cnx, market, brand, item, img_file, pred_result, probability, recognition_time):
    cur = cnx.cursor()

    try:
        log_text = "Inserting image into DB"
        write_log(log_text)
        
        if pred_result is None:
            stmt = "INSERT INTO images (item_id, link, path, pred_label, pred_model, pred_serial, pred_prob, pred_price, pred_img, pred_time, created_at) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())" 
            cur.execute(stmt, [item['item_id'], img_file['link'], "/images/{0}/{1}/{2}/{3}".format(market, brand, item['item_id'], img_file['filename']), '', '', '', "{}".format(probability), '', '', "{}".format(recognition_time)])
        else:
            stmt = "INSERT INTO images (item_id, link, path, pred_label, pred_model, pred_serial, pred_prob, pred_price, pred_img, pred_time, created_at) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())" 
            cur.execute(stmt, [item['item_id'], img_file['link'], "/images/{0}/{1}/{2}/{3}".format(market, brand, item['item_id'], img_file['filename']), pred_result['label'], pred_result['model'], pred_result['type'], "{}".format(probability), pred_result['price'], pred_result['photo'], "{}".format(recognition_time)])
        cnx.commit()
        
        log_text = "Inserting image into DB success"
        write_log(log_text)
    except:
        cnx.rollback()
        print_exception()
        
        log_text = "Inserting image into DB failed"
        write_log(log_text)
        
        raise

    cur.close()


def insert_recognition_db(cnx, brand, item, recognition_result, probability, elapsed_time, result_str, profit_rate_setting, profit_rate_real):
    cur = cnx.cursor()

    try:
        log_text = "Inserting recognition into DB"
        write_log(log_text)
        
        stmt = ("UPDATE items SET \n" +
            "d_label=%s, \n" +
            "d_brand=%s, \n" +
            "d_model=%s, \n" +
            "d_serial=%s, \n" +
            "d_price=%s, \n" +
            "d_files=%s, \n" +
            "d_prob=%s, \n" +
            "d_time=%s, \n" +
            "d_result=%s, \n" +
            "d_profit_rate_setting=%s, \n" +
            "d_profit_rate_real=%s\n" +
            "WHERE `item_id`=%s;")
        #write_log(stmt % (recognition_result['label'], brand, recognition_result['model'], recognition_result['type'], recognition_result['price'], recognition_result['photo'], float(probability), float(elapsed_time), result_str, float(profit_rate_setting), round(float(profit_rate_real), 8), item['item_id'] ))
        cur.execute(stmt, [recognition_result['label'], brand, recognition_result['model'], recognition_result['type'], recognition_result['price'], recognition_result['photo'], float(probability), float(elapsed_time), result_str, float(profit_rate_setting), round(float(profit_rate_real), 8), item['item_id'] ])
        cnx.commit()
        
        log_text = "Inserting recognition into DB success"
        write_log(log_text)
    except:
        cnx.rollback()
        print_exception()
        
        log_text = "Inserting recognition into DB failed"
        write_log(log_text)
        
        raise

    cur.close()


def download_file(path, link, img_file_name):
    #urllib.request.urlretrieve(link, path + "\{0}".format(img_file_name))
    if os.path.exists(path + "\{0}".format(img_file_name)):
        log_text = "Already exists... {}".format(link)
        write_log(log_text)
    else:
        log_text = "downloading: {}".format(link)
        write_log(log_text)
        
        urllib.request.urlretrieve(link, path + "\{0}".format(img_file_name))
        
        log_text = "downloading success & sleeping 3 seconds"
        write_log(log_text)
        
        time.sleep(3)


def chk_bid(item_id):
    return True


def login_google(driver):
    email    = config.google['email']
    password = config.google['password']
    
    driver.get('https://accounts.google.com')
    time.sleep(1.5)
    driver.find_element_by_xpath("//*[@id='identifierId']").send_keys(email)
    driver.find_element_by_xpath("//*[@id='identifierNext']").click()
    time.sleep(2)
    driver.find_element_by_xpath("//*[@id='password']/div[1]/div/div[1]/input").send_keys(password)
    driver.find_element_by_xpath("//*[@id='passwordNext']").click()
    time.sleep(5)


def login_mercari(browser, cnx):
    email    = config.mercari['email']
    password = config.mercari['password']

    browser.get("http://localhost:8888/jp/login/")
    log_text = "Login Page is ready!"
    write_log(log_text)
    
    while True:
        try:
            profilebutton = driver.find_element_by_class_name("sp-header-user-profile")
            if profilebutton:
                break;
            else:
                log_text="Not logged in yet"
                write_log(log_text)
                time.sleep(1)
        except Exception as e:
            time.sleep(1)
    
    log_text = "Login Success!"
    write_log(log_text)
    start_mercari(browser, cnx)


def start_mercari(browser, cnx):
    while True:
        search_mercari(driver, cnx)
        log_text = "------------------------------ Sleeping 60 seconds -----------------------------------"
        write_log(log_text)
        time.sleep(60)


def get_mercari_contents(driver, cnx, market, brand):
    if not os.path.exists("FlaskWeb\images\{0}".format(market)):
        os.mkdir("FlaskWeb\images\{0}".format(market))
    if not os.path.exists("FlaskWeb\images\{0}\{1}".format(market, brand)):
        os.mkdir("FlaskWeb\images\{0}\{1}".format(market, brand))

    # l-container
    objects = driver.find_elements_by_class_name(mercariSettings['itemClass'])

    log_text = ">>>>>>>>>>>>>>>> market: {0} brand: {1} start >>>>>>>>>>>>>>>>>>>>".format(str(market), str(brand))
    write_log(log_text)
    watches = []

    count = 0
    while True:
        for obj in objects:
            try:
                count = count + 1

                # log
                log_text = "  count: {}".format(str(count))
                write_log(log_text)

                obj2 = obj.find_elements_by_tag_name("a")
                confirm_href = obj2[0].get_attribute("href")
                #print(confirm_href)

                obj3 = obj.find_element_by_class_name(mercariSettings['nameTagClass'])
                title = obj3.text
                #print("title:" + title)
                
                is_junk = False
                for stop_word in stop_words:
                    my_title = replace_strange_strings(title.upper())
                    if my_title.find(stop_word) > -1:
                        is_junk = True
                        break
                
                if is_junk:
                    continue

                obj4 = obj.find_element_by_class_name(mercariSettings['priceTagClass'])
                price = obj4.text[1:]
                price = price.replace(',', '')
                #print("price:" + price)
                likes = "0"
                obj5 = obj.find_element_by_class_name('items-box-num').find_elements_by_tag_name('span')
                if obj5:
                    likes = obj5[0].text
                if likes is "":
                    likes = "0"
                #print("likes:" + likes)

                posconfirm_href = confirm_href.find("?_s=")
                #print("posconfirm_href:" + str(posconfirm_href))
                if posconfirm_href == -1:
                    continue
                else:    
                    confirm_href = confirm_href[:posconfirm_href]
                    #print(confirm_href)

                page_pre_href = "https://www.mercari.com/jp/items/"
                item_id = confirm_href.replace(page_pre_href, "")
                item_id = item_id.replace("/", "")
                
                watches.append({'item_id': item_id, 'title': title, 'price': price, 'likes': likes, 'brand': brand})
            except Exception as e:
                print_exception()
                print("not found")

        try:
            next_page_btn = driver.find_element_by_css_selector("li.pager-next li.pager-cell > a")

            if next_page_btn:
                log_text = " >>>>>>>>>>>>>>>>>>>>>> Next Page"
                write_log(log_text)
                break
                #next_page_btn.click()
                #time.sleep(5)
                #objects = driver.find_elements_by_class_name(mercariSettings['itemClass'])
            else:
                break
        except Exception as e:
            print_exception()
            break
    
    
    check_items_with_db(driver, cnx, watches, market, brand)


def check_items_with_db(driver, cnx, array, market, brand):
    new_array = []
    cur = cnx.cursor(buffered=True)
    
    for item in array:
        stmt = "SELECT * FROM items WHERE item_id = %s"
        try:
            cur.execute(stmt, [item['item_id']])
        except Exception as e:
            raise errors.InternalError()
        obj = cur.fetchone()
        
        if not obj:
            new_array.append(item)
        
    if len(new_array) == 0:
        log_text = "No new items!!!"
        write_log(log_text)
    else:
        log_text = "{} new items detected".format(str(len(array)))
        write_log(log_text)
        
        handle_new_items(driver, cnx, new_array, market, brand)


def handle_new_items(driver, cnx, array, market, brand):
    try:
        while len(array):
            item = array.pop()

            log_text = "Watch: {} started".format(item['item_id'])
            write_log(log_text)

            img_path = "FlaskWeb\images\{0}\{1}\{2}".format(market, brand, item['item_id'])
            if not os.path.exists(img_path):
                os.mkdir(img_path)

            item_link = "https://www.mercari.com/jp/items/{0}".format(item['item_id'])
            item['link'] = item_link
            
            driver.get(item_link)
            delay = 5 # seconds
            try:
                myElem = WebDriverWait(driver, delay).until(EC.presence_of_element_located((By.CLASS_NAME, 'item-box-container')))
                
                log_text = "Page loaded"
                write_log(log_text)
            except TimeoutException:
                log_text = "Loading took too much time!"
                write_log(log_text)

            item['seller_name']     = ''
            item['seller_link']     = ''
            item['status']          = ''
            item['shipping_charge'] = ''
            item['shipping_origin'] = ''
            item['shipping_date']   = ''
            item['detail']          = ''

            detail_table = driver.find_element_by_class_name('item-detail-table')
            if detail_table:
                item['seller_name']     = detail_table.find_elements_by_tag_name('tr')[0].find_element_by_tag_name('a').get_attribute("text")
                item['seller_link']     = detail_table.find_elements_by_tag_name('tr')[0].find_element_by_tag_name('a').get_attribute("href")
                item['status']          = detail_table.find_elements_by_tag_name('tr')[3].find_element_by_tag_name('td').get_attribute("innerText")
                item['shipping_charge'] = detail_table.find_elements_by_tag_name('tr')[4].find_element_by_tag_name('td').get_attribute("innerText")
                item['shipping_origin'] = detail_table.find_elements_by_tag_name('tr')[6].find_element_by_tag_name('td').get_attribute("innerText")
                item['shipping_date']   = detail_table.find_elements_by_tag_name('tr')[7].find_element_by_tag_name('td').get_attribute("innerText")
            
            description_tag = driver.find_element_by_class_name('item-description-inner')
            if description_tag:
                item['detail']  = description_tag.get_attribute("innerHTML")

            item['images'] = []
            #image_divs = driver.find_elements_by_class_name("owl-dot-inner")
            image_divs = driver.find_elements_by_class_name("owl-item-inner")

            for tag in image_divs:
                #img_link = tag.find_elements_by_tag_name("img")[0].get_attribute("href")
                img_link = tag.find_elements_by_tag_name("img")[0].get_attribute("data-src")
                img_file_name = os.path.basename(urlparse(img_link).path)
                item['images'].append({'filename': img_file_name, 'link': img_link})
                download_file(img_path, img_link, img_file_name)

            bid_flg = True
            image_mode = True
            predict_result = "success"

            # Text recognition
            recognized_model = ''
            recognized_type = ''
            
            avg_prob = 1

            start = timer()

            my_title = replace_strange_strings(item['title'].upper())
            my_detail = replace_strange_strings(item['detail'].upper())

            watch_models = predefined_types[brand]
            for watch_model in watch_models:
                if my_title.find(watch_model) > -1 or my_detail.find(watch_model) > -1:
                    recognized_model = watch_model
                    #print(" Model is " + recognized_model + " (from text recognition)")
                    image_mode = False
                    break
            if recognized_model:
                for watch_type in watch_models[recognized_model]:
                    if my_title.find(watch_type) > -1 or my_detail.find(watch_type) > -1:
                        recognized_type = watch_type
                        break
                if recognized_type == '':
                    type_length = len(watch_models[recognized_model])
                    if type_length == 1:
                        recognized_type = watch_models[recognized_model][0]
                    else:
                        recognized_type = watch_models[recognized_model][random.randint(0, type_length - 1)]

                result_item = get_item_by_name(recognized_model, recognized_type)

                if result_item is None:
                    image_mode = True
                else:
                    log_text = " Text Recognition success"
                    write_log(log_text)
                    result_item['type'] = recognized_type
                    predict_result = "text_success"
                    for file in item['images']:
                        insert_image_db(cnx, market, item['brand'], item, file, result_item, 1, 0)
            
            end = timer()
            # End Text recognition
            
            if image_mode:
                start = timer()
                img_pred_result = predict_item(market, item, cnx)
                result_labels = img_pred_result['labels']
                max_label_idx = np.argmax(result_labels)
                result_item = get_item_for_label(max_label_idx)

                end = timer()
                # at least two prediction must be same
                #if result_labels[max_label_idx] < len(item['images']) * 0.3:
                if result_labels[max_label_idx] < 2:
                    # log to file
                    log_text = "  no dominant prediction"
                    write_log(log_text)
                    # End log to file
                    
                    predict_result = "no_dominant_prediction"
                    bid_flg = False
                else:
                    result_probs = img_pred_result['probs']
                    avg_prob = result_probs[max_label_idx] / result_labels[max_label_idx]
                    
                    log_text = "  max average prob: {0}".format(avg_prob)
                    write_log(log_text)
                    
                    # average prob for the most frequent prediction must be over 0.5
                    if avg_prob < 0.5:
                        log_text = "  average prob is less than 0.5"
                        write_log(log_text)
                        predict_result = "prob_too_low"
                        bid_flg = False

            item['recognition_time'] = end - start

            if False:
                cur = cnx.cursor(dictionary=True)
                cur.execute("SELECT value FROM c_settings WHERE `key` = 'profit_rate'")
                profit_rate = cur.fetchone()
                if profit_rate is not None and profit_rate['value'] != '':
                    profit_rate = float(profit_rate['value'].strip())
                else:
                    profit_rate = 0
            
            profit_rate = 0
            
            item_price = float(item['price'])
            result_price = float(result_item['price'])
            
            profit_rate_real = (result_price - item_price) * 100 / result_price

            # price must be lower than the limit
            if profit_rate_real <= profit_rate:
                log_text = "  Price is too high"
                write_log(log_text)
                
                predict_result = "price_too_high"
                bid_flg = False
            elif result_item['type'] == '':
                log_text = "  No serial"
                write_log(log_text)
                
                predict_result = "no_serial"
                bid_flg = False
            elif False:
                cur.execute("SELECT value FROM c_settings WHERE `key` = 'upper_price_check'")
                upper_price_check = cur.fetchone()
                if upper_price_check is not None:
                    upper_price_check = upper_price_check['value']

                if upper_price_check == '1':
                    cur.execute("SELECT value FROM c_settings WHERE `key` = 'upper_price'")
                    upper_price = cur.fetchone()
                    if upper_price is not None:
                        upper_price = float(upper_price['value'])

                        # price must be lower than the upper_price
                        if item_price > upper_price:
                            log_text = "  Price is higher than upper limit"
                            write_log(log_text)
                            
                            predict_result = "price_upper_limit"
                            bid_flg = False

            connected = cnx.is_connected()
            if (not connected):
                cnx.ping(True)

            cursor = cnx.cursor(dictionary=True)
            cursor.execute("SELECT value FROM c_settings WHERE `key` = 'auto_purchase_status'")
            status = cursor.fetchone()
            if status is not None and status['value'] == '1':
                if bid_flg:
                    log_text = "bid"
                    write_log(log_text)
                    
                    # process purchase
                    bid_flg = buy_item(driver)
            else:
                bid_flg = 'disabled'

            connected = cnx.is_connected()
            if (not connected):
                cnx.ping(True)
            insert_item_db(cnx, item, market, brand, bid_flg)
            insert_recognition_db(cnx, brand, item, result_item, avg_prob, item['recognition_time'], predict_result, profit_rate, profit_rate_real)

        log_text = "Round is over"
        write_log(log_text)
        
    except Exception as e:
        print_exception()


def buy_item(driver):
    trials = 0;
    while True:
        trials += 1
        if trials > 3:
            return False
        try:
            submit_button = driver.find_element(By.XPATH, "//a[@class='item-buy-btn']")
            #submitbutton = driver.find_element_by_link_text("購入画面に進む")
            if submit_button:
                driver.get(submit_button.get_attribute("href"))
                break
            else:
                write_log('purchase button cannot be found. trying again...')
        except Exception as e:
            print_exception()
            time.sleep(1)
    time.sleep(3)
    
    trials = 0;
    while True:
        trials += 1
        if trials > 3:
            return False
        try:
            payment_type = driver.find_element_by_xpath("//*[@data-test='cvs-atm-text']")
            if payment_type:
                payment_type.click()
                write_log('payment type has been set to Convini/ATM')
            else:
                write_log('Convini/ATM setting cannot be found. trying again...')
            
            submit_button = driver.find_element_by_xpath("//*[@data-test='transaction-buy-purchase']")
            if submit_button:
                submit_button.click()
                write_log('purchase complete')
            else:
                write_log('purchase failed. trying again...')
            break
        except Exception as e:
            write_log('no element, trying again 2')
            print_exception()
            time.sleep(1)

    return True


def search_mercari(browser, cnx):
    market = 1

    for key in aBrandWatch:
        brand = key
        driver.get("https://www.mercari.com/jp/brand/" + str(brand) + "/265")
        get_mercari_contents(browser, cnx, market, brand)


if __name__ == '__main__':

    driver = webdriver.Chrome(executable_path=r"chromedriver.exe")

    cnx = mysql.connector.connect(**config.mysql)

    clock_items = get_clock_items()

    login_mercari(driver, cnx) 



