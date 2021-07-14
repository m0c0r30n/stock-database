import requests
import MySQLdb
import re
from bs4 import BeautifulSoup
from selenium.webdriver.support.select import Select
from selenium import webdriver
from time import sleep
import datetime
import os
import pandas as pd

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

kessan_info_table = 'kessan_info'
df = pd.read_excel('./kessan06_0702.xlsx', index_col=0)

df_r = df.reset_index()


for index, row in df_r.iterrows():
    try:
        if (row['発表予定日'] != '未定' and row['業種名'] != 'インフラファンド' and row['業種名'] != 'REIT'):
            happyo_date = row['発表予定日'].date()
            stock_number = row['コード']
            name = row['会社名']
            gyoshu_name = row['業種名']
            quarter = row['種別']
            market = row['市場区分']

            cur.execute('insert into kessanyoteis (happyo_date, stock_number, name, gyoshu, quarter, market) values(%s, %s, %s, %s, %s, %s) ', (happyo_date, int(stock_number), str(name), str(gyoshu_name), str(quarter), str(market)))
            print(stock_number)
            print("########")
    except:
        print("error")

df2 = pd.read_excel('./kessan05_0702.xlsx', index_col=0)

df2_r = df2.reset_index()

for index, row in df2.iterrows():
    try:
        if (row['発表予定日'] != '未定' and row['業種名'] != 'インフラファンド' and row['業種名'] != 'REIT'):
            happyo_date = row['発表予定日'].date()
            stock_number = row['コード']
            name = row['会社名']
            gyoshu_name = row['業種名']
            quarter = row['種別']
            market = row['市場区分']

            cur.execute('insert into kessanyoteis (happyo_date, stock_number, name, gyoshu, quarter, market) values(%s, %s, %s, %s, %s, %s) ', (happyo_date, int(stock_number), str(name), str(gyoshu_name), str(quarter), str(market)))
            print(stock_number)
            print("########")
    except:
        print("error")
        
conn.commit()
cur.close()
conn.close()