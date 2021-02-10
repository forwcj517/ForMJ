# coding: utf-8
"""
Routes and views for the flask application.
"""

from datetime import datetime
import pytz

from flask import render_template
from flask import Flask, flash, request, redirect, url_for
from flask import send_from_directory
from flask import Flask, session
from flask.json import jsonify

from werkzeug.utils import secure_filename
import os

from FlaskWeb import app

import mysql.connector
import config

import time
from time import gmtime, strftime
from timeit import default_timer as timer

import base64
import io


@app.errorhandler(404)
def page_not_found(e):
    # note that we set the 404 status explicitly
    return render_template(
        '404.html',
        title=u'404',
        body_class=u'skin-blue sidebar-mini',
    ), 404
    # return redirect(url_for('index'))

@app.route('/')
def index():
    if not check_session():
        return redirect(url_for('login'))

    return redirect(url_for('watches'))

    mes = []

    return render_template(
        'home.html',
        title=u'ホーム',
        body_class=u'skin-blue sidebar-mini',
        active_menu=1,
        message=mes)

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'GET':
        """Renders the login page."""
        return render_template(
            'login.html',
            title=u'ログイン',
            body_class=u'login-page')
    else:
        id = request.form['id']
        pwd = request.form['password']

        db = mysql.connector.connect(**config.mysql)
        cursor = db.cursor()
        cursor.execute("SELECT * FROM `users` WHERE `username` = '" + id + "' AND `password` = PASSWORD('" + pwd + "')")
        data = cursor.fetchone()
        cursor.close()
        db.close()

        if data is None:
            return redirect(url_for('login'))
        else:
            session['auth'] = 'true'
            session['building-number'] = data[1]
            session['building-name'] = data[2]
            return redirect(url_for('index'))

@app.route('/logout')
def logout():
    session['auth'] = 'false'
    return redirect(url_for('login'))


@app.route('/watches')
def watches():
    if not check_session():
        return redirect(url_for('login'))

    mes = []
    
    return render_template(
        'list.html',
        title=u'時計一覧',
        body_class=u'skin-blue sidebar-mini',
        active_menu=2,
        message=mes)


@app.route('/list', methods=['POST'])
def list():
    offset = int(request.form.get('start'))
    limit = int(request.form.get('length'))
    draw = int(request.form.get('draw'))
    search = request.form.get('search')
    order = request.form.get('order')
    order_direction = request.form.get('order_dir')

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT value FROM d_settings WHERE `key` = 'profit_rate'")
    profit_rate = cursor.fetchone()
    if profit_rate is None:
        profit_rate = 0
    else:
        profit_rate = float(profit_rate['value'])

    order_field = None
    if order == '1':
        order_field = 'title'
    elif order == '2':
        order_field = 'd_price'
    elif order == '3':
        order_field = 'price'
    elif order == '4':
        order_field = 'd_price - price'
    elif order == '5':
        order_field = 'd_profit_rate_real'
    elif order == '6':
        order_field = 'd_time'
    elif order == '7':
        order_field = 'purchased'
    elif order == '8':
        order_field = 'updated_at'
    
    smt = "SELECT * FROM items WHERE d_serial <> '' AND d_profit_rate_real >= %s AND purchased='True' "
    params = [profit_rate]
    if search is not '':
        smt = smt + "AND title LIKE %s "
        params.append('%' + search + '%')

    if order_field is None:
        smt = smt + "ORDER BY id DESC"
    else:
        smt = smt + "ORDER BY " + order_field + " " + order_direction.upper()
        #params.append(order_field)

    start = timer()
    cursor.execute(smt, params)
    total_items = cursor.fetchall()
    end = timer()
    print(end-start)

    if total_items is not None:
        total_number = len(total_items)
    else:
        total_number = 0
    
    session['total-number'] = total_number
    
    cursor.close()
    db.close()

    data = []
    id = 1
    for item in total_items[offset:offset+limit]:
        data.append(
            {
                'id': offset + id,
                'title': '<a href="' + item['link'] + '">' + item['title'] + '</a>',
                'price_limit': '{:20,.0f}'.format(float(item['d_price'])) + '円',
                'price': '{:20,.0f}'.format(float(item['price'])) + '円',
                'price_diff': '{:20,.0f}'.format(float(item['d_price']) - float(item['price'])) + '円',
                'profit_rate': '{:20,.1f}'.format(float(item['d_profit_rate_real'])) + '％',
                'recognition_time': '{:20,.3f}'.format(float(item['d_time'])) + '秒',
                'purchase': '<span class="badge bg-green"><i class="fa fa-check"></i> ' + item['purchased'] + '</span>' if item['purchased'] == 'True' else '<span class="badge bg-danger"><i class="fa fa-times"></i> ' + item['purchased'] + '</span>',
                'updated_at': item['updated_at'].strftime('%Y-%m-%d %H:%M:%S'),
                'button': '<a href="detail/' + item['item_id'] + '" class="btn btn-info">詳細</a>',
            }
        )
        id = id + 1

    return jsonify({"draw": draw, "recordsTotal": total_number, "recordsFiltered": total_number, "data": data})


@app.route('/detail/<id>')
def detail(id):
    if not check_session():
        return redirect(url_for('login'))

    mes = []

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT * FROM items WHERE item_id='" + id + "'")
    data = cursor.fetchone()
    
    cursor.execute("SELECT * FROM images WHERE item_id='" + id + "'")
    images = cursor.fetchall()
    
    cursor.close()
    db.close()

    return render_template(
        'detail.html',
        title=u'時計情報',
        body_class=u'skin-blue sidebar-mini',
        data=data,
        images=images,
        active_menu=2,
        message=mes)


@app.route('/debug/<id>')
def debug(id):
    if not check_session():
        return redirect(url_for('login'))

    mes = []

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT * FROM items WHERE item_id='" + id + "'")
    data = cursor.fetchone()
    
    cursor.execute("SELECT * FROM images WHERE item_id='" + id + "'")
    images = cursor.fetchall()
    
    cursor.close()
    db.close()

    return render_template(
        'debug.html',
        title=u'時計情報',
        body_class=u'skin-blue sidebar-mini',
        data=data,
        images=images,
        active_menu=2,
        message=mes)


@app.route('/d_settings', methods=['GET', 'POST'])
def d_settings():
    if not check_session():
        return redirect(url_for('login'))

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)

    if request.method == 'GET':
        mes=[]

        cursor.execute("SELECT value FROM d_settings WHERE `key` = 'profit_rate'")
        profit_rate = cursor.fetchone()
        if profit_rate is None:
            profit_rate = ''
        else:
            profit_rate = profit_rate['value']
    else:
        profit_rate = request.form['profit_rate']
        
        cursor.execute("DELETE FROM d_settings WHERE `key` = 'profit_rate';")
        cursor.execute("INSERT INTO d_settings VALUES ('%s', '%s')" % ('profit_rate', profit_rate))

        mes=[{'content': '設定を保存しました！'}]

        smt = "SELECT count(*) AS cnt FROM items WHERE d_serial <> '' AND d_profit_rate_real > %s;"
        cursor.execute(smt, [float(profit_rate)])
        total_number = cursor.fetchone()
        session['total-number'] = total_number['cnt']

    cursor.close()
    db.close()

    return render_template(
        'd_settings.html',
        title=u'設定 | 表示設定',
        body_class=u'skin-blue sidebar-mini',
        active_menu=3,
        message=mes,
        profit_rate=profit_rate)


@app.route('/c_settings', methods=['GET', 'POST'])
def c_settings():
    if not check_session():
        return redirect(url_for('login'))

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)

    if request.method == 'GET':
        mes=[]

        cursor.execute("SELECT value FROM c_settings WHERE `key` = 'auto_purchase_status'")
        status = cursor.fetchone()
        if status is None:
            status = '0'
        else:
            status = status['value']

        if False:
            cursor.execute("SELECT value FROM c_settings WHERE `key` = 'profit_rate'")
            profit_rate = cursor.fetchone()
            if profit_rate is None:
                profit_rate = ''
            else:
                profit_rate = profit_rate['value']

            cursor.execute("SELECT value FROM c_settings WHERE `key` = 'upper_price'")
            upper_price = cursor.fetchone()
            if upper_price is None:
                upper_price = ''
            else:
                upper_price = upper_price['value']

            cursor.execute("SELECT value FROM c_settings WHERE `key` = 'upper_price_check'")
            upper_price_check = cursor.fetchone()
            if upper_price_check is None:
                upper_price_check = False
            else:
                upper_price_check = upper_price_check['value']
    else:
        status = request.form['status']
        cursor.execute("DELETE FROM c_settings WHERE `key` = 'auto_purchase_status';")
        cursor.execute("INSERT INTO c_settings VALUES ('%s', '%s')" % ('auto_purchase_status', status))
        
        if False:
            profit_rate = request.form['profit_rate']
            upper_price = request.form['upper_price']
            if 'upper_price_check' in request.args:
                upper_price_check = '1'
            else:
                upper_price_check = '0'
        
            cursor.execute("DELETE FROM c_settings WHERE `key` = 'profit_rate';")
            cursor.execute("DELETE FROM c_settings WHERE `key` = 'upper_price';")
            cursor.execute("DELETE FROM c_settings WHERE `key` = 'upper_price_check';")
            
            cursor.execute("INSERT INTO c_settings VALUES ('%s', '%s')" % ('profit_rate', profit_rate))
            cursor.execute("INSERT INTO c_settings VALUES ('%s', '%s')" % ('upper_price', upper_price))
            cursor.execute("INSERT INTO c_settings VALUES ('%s', '%s')" % ('upper_price_check', upper_price_check))

        mes=[{'content': '設定を保存しました！'}]


    cursor.close()
    db.close()

    return render_template(
        'c_settings.html',
        title=u'設定 | 収集設定',
        body_class=u'skin-blue sidebar-mini',
        active_menu=4,
        message=mes,
        status=status,
        #profit_rate=profit_rate,
        #upper_price=upper_price,
        #upper_price_check=upper_price_check
        )


@app.route('/tests')
def tests():
    if not check_session():
        return redirect(url_for('login'))

    mes = []
    list = []

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    
    #current_date = strftime("%Y-%m-%d %H:%M:%S", gmtime())
    current_date = strftime("%Y-%m-%d", gmtime())

    cursor.execute("SELECT * FROM recognition_tests WHERE 1 ORDER BY `date`")
    list = cursor.fetchall()
    
    #if current_date > "2020-05-31" or current_date < "2020-05-12":
    #    cursor.execute("SELECT * FROM tests WHERE 1")
    #    list = cursor.fetchall()
    #else:
    #    for date in range(11, 31):
    #        if date >= int(strftime("%d", gmtime())):
    #            continue

    #        date_string = "2020-05-{0}".format(date)
    #        stmt = "SELECT * FROM tests WHERE `date` = %s"
    #        cursor.execute(stmt, [date_string])
    #        data = cursor.fetchone()

    #        if data is None:
    #            data = {
    #                'date': date_string,
    #                'total_watches': 0,
    #                'total_images': 0,
    #                'new_watches': 0,
    #                'new_images': 0,
    #                'total_avg_rate': '',
    #                'new_avg_rate': ''}

    #            stmt = "SELECT COUNT(DISTINCT items.item_id) AS watch_count, SUM(images.pred_prob) AS rate_sum, COUNT(images.id) AS image_count FROM items LEFT JOIN images ON items.item_id = images.item_id WHERE images.pred_prob > 0.5 AND `items`.created_at < %s"
    #            cursor.execute(stmt, [date_string + ' 23:59:59'])
    #            total_data = cursor.fetchone()

    #            data['total_watches'] = total_data['watch_count']
    #            data['total_images'] = total_data['image_count']
    #            if total_data['rate_sum'] is None:
    #                data['total_avg_rate'] = ''
    #            else:
    #                data['total_avg_rate'] = float(total_data['rate_sum']) / float(total_data['image_count'])

    #            if date == 12:
    #                cursor.execute("SELECT COUNT(DISTINCT items.item_id) AS watch_count, SUM(images.pred_prob) AS rate_sum, COUNT(images.id) AS image_count FROM items LEFT JOIN images ON items.item_id = images.item_id WHERE `items`.created_at < '2020-05-13'")
    #            else:
    #                stmt = "SELECT COUNT(DISTINCT items.item_id) AS watch_count, SUM(images.pred_prob) AS rate_sum, COUNT(images.id) AS image_count FROM items LEFT JOIN images ON items.item_id = images.item_id WHERE images.pred_prob > 0.5 AND `items`.created_at LIKE %s"
    #                cursor.execute(stmt, [date_string + '%'])
    #            new_data = cursor.fetchone()

    #            data['new_watches'] = new_data['watch_count']
    #            data['new_images'] = new_data['image_count']
    #            if new_data['rate_sum'] is None:
    #                data['new_avg_rate'] = ''
    #            else:
    #                data['new_avg_rate'] = float(new_data['rate_sum']) / float(new_data['image_count'])


    #            stmt = "INSERT INTO tests (`date`, `total_watches`, `total_images`, `new_watches`, `new_images`, `total_avg_rate`, `new_avg_rate`) VALUES (%s, %s, %s, %s, %s, %s, %s)"
    #            cursor.execute(stmt, [date_string, data['total_watches'], data['total_images'], data['new_watches'], data['new_images'], data['total_avg_rate'], data['new_avg_rate']])

    #        list.append(data)
    
    #if 'all' in request.args:
    #    cursor.execute("SELECT items.*, recognitions.price AS price_limit, recognitions.time, recognitions.profit_rate_real FROM items LEFT JOIN recognitions ON items.item_id = recognitions.item_id WHERE 1")
    #else:
    #    cursor.execute("SELECT value FROM d_settings WHERE `key` = 'profit_rate'")
    #    profit_rate = cursor.fetchone()
    #    if profit_rate is None:
    #        profit_rate = 0
    #    else:
    #        profit_rate = float(profit_rate['value'])
    #
    #    smt = "SELECT items.*, recognitions.price AS price_limit, recognitions.time, recognitions.profit_rate_real FROM items LEFT JOIN recognitions ON items.item_id = recognitions.item_id WHERE recognitions.result <> 'price_too_high' AND recognitions.serial <> '' AND recognitions.profit_rate_real >= %s;"
    #    cursor.execute(smt, [profit_rate])
    
    cursor.close()
    db.close()

    return render_template(
        'tests.html',
        title=u'テスト結果',
        body_class=u'skin-blue sidebar-mini',
        list=reversed(list),
        active_menu=5,
        message=mes)


@app.route('/tests/<month>/<date>')
def tests_date(month, date):
    if not check_session():
        return redirect(url_for('login'))

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    
    date_string = "2020-{0}-{1}".format(month, date)
    stmt = "SELECT * FROM recognition_tests WHERE `date` = %s"
    cursor.execute(stmt, [date_string])
    data = cursor.fetchone()

    if data is None:
        data = {
            'date': date_string,
            'total_watches': 0,
            'total_images': 0,
            'new_watches': 0,
            'new_images': 0,
            'total_avg_rate': '',
            'new_avg_rate': ''}

        stmt = "SELECT COUNT(DISTINCT items.item_id) AS watch_count, SUM(images.pred_prob) AS rate_sum, COUNT(images.id) AS image_count FROM items LEFT JOIN images ON items.item_id = images.item_id WHERE `items`.updated_at < %s"
        cursor.execute(stmt, [date_string + ' 23:59:59'])
        total_data = cursor.fetchone()

        data['total_watches'] = total_data['watch_count']
        data['total_images'] = total_data['image_count']
        if total_data['rate_sum'] is None:
            data['total_avg_rate'] = ''
        else:
            data['total_avg_rate'] = float(total_data['rate_sum']) / float(total_data['image_count'])

        stmt = "SELECT COUNT(DISTINCT items.item_id) AS watch_count, SUM(images.pred_prob) AS rate_sum, COUNT(images.id) AS image_count FROM items LEFT JOIN images ON items.item_id = images.item_id WHERE `items`.updated_at LIKE %s"
        cursor.execute(stmt, [date_string + '%'])
        new_data = cursor.fetchone()

        data['new_watches'] = new_data['watch_count']
        data['new_images'] = new_data['image_count']
        if new_data['rate_sum'] is None:
            data['new_avg_rate'] = ''
        else:
            data['new_avg_rate'] = float(new_data['rate_sum']) / float(new_data['image_count'])


        stmt = "INSERT INTO recognition_tests (`date`, `total_watches`, `total_images`, `new_watches`, `new_images`, `total_avg_rate`, `new_avg_rate`) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        cursor.execute(stmt, [date_string, data['total_watches'], data['total_images'], data['new_watches'], data['new_images'], data['total_avg_rate'], data['new_avg_rate']])
        db.commit()
    
    cursor.close()
    db.close()

    return data


@app.route('/test_del/<month>/<date>')
def test_del(month, date):
    if not check_session():
        return redirect(url_for('login'))

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    
    date_string = "2020-{0}-{1}".format(month, date)
    stmt = "DELETE FROM recognition_tests WHERE `date` = %s"
    cursor.execute(stmt, [date_string])
    db.commit()
    cursor.close()
    db.close()


    return 'success: deleted test data of ' + month + '/' + date

# for merging `items` and `recognitions` tables
@app.route('/update-db-0923')
def update_db_0923():
    #if not check_session():
    #    return redirect(url_for('login'))

    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    
    stmt = "SELECT * FROM items LIMIT 0,1;"
    cursor.execute(stmt)
    item = cursor.fetchone()
    
    if 'd_files' not in item:
        stmt = ("ALTER TABLE `vingtorderdb`.`items` \n" +
            "ADD COLUMN `d_label` varchar(255) NULL AFTER `market_id`,\n" +
            "ADD COLUMN `d_brand` varchar(255) NULL AFTER `d_label`,\n" +
            "ADD COLUMN `d_model` varchar(255) NULL AFTER `d_brand`,\n" +
            "ADD COLUMN `d_serial` varchar(255) NULL AFTER `d_model`,\n" +
            "ADD COLUMN `d_price` varchar(255) NULL AFTER `d_serial`,\n" +
            "ADD COLUMN `d_files` varchar(255) NULL AFTER `d_price`,\n" +
            "ADD COLUMN `d_prob` varchar(255) NULL AFTER `d_files`,\n" +
            "ADD COLUMN `d_time` varchar(255) NULL AFTER `d_prob`,\n" +
            "ADD COLUMN `d_result` varchar(255) NULL AFTER `d_time`,\n" +
            "ADD COLUMN `d_profit_rate_setting` varchar(255) NULL AFTER `d_result`,\n" +
            "ADD COLUMN `d_profit_rate_real` varchar(255) NULL AFTER `d_profit_rate_setting`")
        cursor.execute(stmt)
        db.commit()
    
    stmt = "SELECT * FROM `recognitions`";
    cursor.execute(stmt)
    recognitions = cursor.fetchall()
    
    for recognition in recognitions:
        stmt = ("UPDATE `items` SET\n" +
        "d_label=%s,\n" +
        "d_brand=%s,\n" +
        "d_model=%s,\n" +
        "d_serial=%s,\n" +
        "d_price=%s,\n" +
        "d_files=%s,\n" +
        "d_prob=%s,\n" +
        "d_time=%s,\n" +
        "d_result=%s,\n" +
        "d_profit_rate_setting=%s,\n" +
        "d_profit_rate_real=%s " +
        "WHERE item_id=%s")
        cursor.execute(stmt, [recognition['label'], recognition['brand'], recognition['model'], recognition['serial'], recognition['price'], recognition['files'], recognition['prob'], recognition['time'], recognition['result'], recognition['profit_rate_setting'], recognition['profit_rate_real'], recognition['item_id']])
        db.commit()
        
        stmt = "DELETE FROM recognitions WHERE `id` = %s"
        cursor.execute(stmt, [recognition['id']])
        db.commit()
    
    cursor.close()
    db.close()


    return 'success: merged recognition data - ' + str(len(recognitions))

##########################################################################
def check_session():
    if 'auth' not in session:
        session['auth'] = 'false'

    # Total number of watches displayed at sidebar
    db = mysql.connector.connect(**config.mysql)
    cursor = db.cursor(dictionary=True)
    
    cursor.execute("SELECT value FROM d_settings WHERE `key` = 'profit_rate'")
    profit_rate = cursor.fetchone()
    if profit_rate is None:
        profit_rate = 0
    else:
        profit_rate = float(profit_rate['value'])

    smt = "SELECT count(*) AS cnt FROM items WHERE d_serial <> '' AND d_profit_rate_real > %s AND purchased='True';"
    cursor.execute(smt, [profit_rate])
    total_number = cursor.fetchone()
    session['total-number'] = total_number['cnt']
    cursor.close()
    db.close()
    # End Total number

    return session['auth'] == 'true'


@app.route('/images/<path:path>')
def temp_files(path):
    return send_from_directory('images', path)


@app.template_filter('datetimefilter')
def datetimefilter(value, format='%Y-%m-%d %H:%M:%S'):
    tz = pytz.timezone('Asia/Tokyo')  # timezone you want to convert to from UTC (America/Los_Angeles)
    utc = pytz.timezone('UTC')
    value = utc.localize(value, is_dst=None).astimezone(pytz.utc)
    local_dt = value.astimezone(tz)
    return local_dt.strftime(format)


@app.context_processor
def inject_enumerate():
    return dict(enumerate=enumerate)
