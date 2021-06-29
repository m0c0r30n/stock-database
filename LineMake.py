import requests
import MySQLdb
import re
from bs4 import BeautifulSoup
from selenium.webdriver.support.select import Select
from selenium import webdriver
from time import sleep
import datetime
import os

conn = MySQLdb.connect(
    host='localhost',
    port=3306,
    user='root',
    password='',
    database='stockdatabase',
    use_unicode=True,
    charset="utf8"
)

cur = conn.cursor()

kabutan_column_table = 'indexes'

cur.execute('select * from indexes where stock_number = 3328')
stocks = cur.fetchall()
stock_dict = {}
lowest_price = 0
highest_price = 0

for stock in stocks:
    high_price = int(stock[7].replace(',', ''))
    low_price = int(stock[8].replace(',', ''))

    if (lowest_price == 0 or lowest_price > low_price):
        lowest_price = low_price
    if (highest_price == 0 or highest_price < high_price):
        highest_price = high_price

for stock in stocks:
    open_price = int(stock[5].replace(',', ''))
    end_price = int(stock[6].replace(',', ''))
    high_price = int(stock[7].replace(',', ''))
    low_price = int(stock[8].replace(',', ''))
    dekidaka = int(stock[10].replace(',', ''))

    if (open_price not in stock_dict):
        stock_dict[open_price] = open_price*dekidaka*0.5
    else:
        stock_dict[open_price] += open_price*dekidaka*0.5
    
    if (end_price not in stock_dict):
        stock_dict[end_price] = (end_price*dekidaka*0.5)
    else:
        stock_dict[end_price] += end_price*dekidaka*0.5

    if (high_price not in stock_dict):
        stock_dict[high_price] = (high_price*dekidaka*0.3)
    else:
        stock_dict[high_price] += high_price*dekidaka*0.3
    
    if (low_price not in stock_dict):
        stock_dict[low_price] = (low_price*dekidaka*0.3)
    else:
        stock_dict[low_price] += low_price*dekidaka*0.3

# print(stock_dict)

ave = (highest_price + lowest_price) / 2
ave_range = int(ave*0.005)
sta_price = lowest_price

stock_list = sorted(stock_dict.items())
last_stock_list = list()
tmp_stock_list = list()
index = 0

# print(stock_list)

for i, n in enumerate(stock_list):
    tmp_stock_list = list()
    # print("low_price :" + str(sta_price))
    # print("price :" + str(n[0]))
    # a = sta_price+ave_range
    # print("high_price :" + str(a))
    # print(" ")
    try:
        if (int(sta_price) <= int(n[0]) and int(n[0]) <= int(sta_price)+int(ave_range)):
            if (len(last_stock_list) == index):
                tmp_stock_list.append(sta_price)
                tmp_stock_list.append(sta_price+ave_range)
                tmp_stock_list.append(n[1])

                last_stock_list.append(tmp_stock_list)
                if (stock_list[i+1][0] >= (sta_price+ave_range)):
                    index += 1
                    sta_price = sta_price+ave_range
            else:
                last_stock_list[index][2] += n[1]
                if (stock_list[i+1][0] >= (sta_price+ave_range)):
                    index += 1
                    sta_price = sta_price+ave_range

        else:
            sta_price += ave_range
            if (len(last_stock_list) == index):
                tmp_stock_list.append(sta_price)
                tmp_stock_list.append(sta_price+ave_range)
                tmp_stock_list.append(n[1])
                print(tmp_stock_list)
                last_stock_list.append(tmp_stock_list)
                if (stock_list[i+1][0] >= (sta_price+ave_range)):
                    index += 1
                    sta_price = sta_price+ave_range
            else:
                last_stock_list[index][2] += n[1]
                if (stock_list[i+1][0] >= (sta_price+ave_range)):
                    index += 1
                    sta_price = sta_price+ave_range
    except Exception as e:
        print("Error", e)

# print(last_stock_list)
tst = sorted(last_stock_list, key=lambda x: x[2])
print(tst)

cur.close()
conn.close()