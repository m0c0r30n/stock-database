import chromedriver_binary
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
    password='passw0rd123?',
    database='stockdatabase',
    use_unicode=True,
    charset="utf8"
)

cur = conn.cursor()

# cur.execute('select * from stockdatabases')
cur.execute('select stockdatabase_id from sikihodatas')
sikihodatas = cur.fetchall()

for sikihodata in sikihodatas:
    stockdatabase_id = sikihodata[0]
    cur.execute('select stock_number from stockdatabases where id = %s;' % stockdatabase_id)
    stock_number = cur.fetchone()
    cur.execute('update sikihodatas set stock_number = %s where stockdatabase_id = %s;', (int(stock_number[0]), int(stockdatabase_id)))
sleep(2)
        
conn.commit()

cur.close()
conn.close()





