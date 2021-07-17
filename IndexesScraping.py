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
    password='moco0205',
    database='kabudatabase',
    use_unicode=True,
    charset="utf8"
)

cur = conn.cursor()
options = webdriver.ChromeOptions()
options.add_argument('--headless')
options.add_argument('--no-sandbox')
options.add_argument('--disable-gpu')
options.add_argument('--lang=ja-JP')
options.add_argument('user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36')
driver = webdriver.Chrome(options=options)

kabutan_column_table = 'indexes'

today = datetime.date.today()

for i in range(1,10):
    nikkeiheikin_url = "https://kabutan.jp/stock/kabuka?code=0010&ashi=day&page="+str(i)
    driver.get(nikkeiheikin_url)

    dates = driver.find_elements_by_xpath("//table[@class='stock_kabuka_dwm']/tbody/tr/th")
    nikkei_numbers = driver.find_elements_by_xpath("//table[@class='stock_kabuka_dwm']/tbody/tr/td")
    cnt = 0
    index = 0
    stock_number = "0010"

    for nikkei_number in nikkei_numbers:
        cnt += 1
        if (cnt == 1):
            date = '20'+dates[index].text
            index += 1
            tdatetime = datetime.datetime.strptime(date, '%Y/%m/%d')
            tdate = datetime.date(tdatetime.year, tdatetime.month, tdatetime.day)
            openprice = nikkei_number.text
            print(date)
            print(openprice)

        elif (cnt == 2):
            highprice = nikkei_number.text
            print(highprice)
        elif (cnt == 3):
            lowprice = nikkei_number.text
            print(lowprice)
        elif (cnt == 4):
            endprice = nikkei_number.text
            print(endprice)
        elif (cnt == 5):
            continue
        elif (cnt == 6): 
            increase_rate = nikkei_number.text
            print(increase_rate)
        elif (cnt == 7):
            dekidaka = nikkei_number.text
            print(dekidaka)
            cur.execute('insert into indexes (stock_number, date, openprice, endprice, highprice, lowprice, dekidaka, increase_rate) values(%s, %s, %s, %s, %s, %s, %s, %s) ', (int(stock_number), tdate, str(openprice), str(endprice), str(highprice), str(lowprice), str(dekidaka), str(increase_rate)))
            cnt = 0
            print("########")
            conn.commit()
            sleep(1)

driver.quit()
cur.close()
conn.close()





