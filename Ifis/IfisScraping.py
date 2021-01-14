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

class IfisScraping():
    def __init__(self):
        self.wadaiurl = "https://kabutan.jp/news/marketnews/?category=9"

        options = webdriver.ChromeOptions()
        options.add_argument('--headless')
        self.driver = webdriver.Chrome(options=options)

    def main(self):
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

        wadai_table = 'wadai_data'
        topfifiteen_table = 'topfifteens'
        stockchange_table = 'stockchanges'
        stockdataabase_table = 'stockdatabases'
        lionnote_table = 'lionnotes'

        cur.execute('SELECT * FROM %s;' % wadai_table)
        wadai_datas = cur.fetchall()

        cur.execute('SELECT * FROM %s;' % topfifiteen_table)
        topfifiteen_datas = cur.fetchall()

        cur.execute('SELECT * FROM %s;' % stockchange_table)
        stockchange_datas = cur.fetchall()
        
        cur.execute('SELECT * FROM %s;' % stockdataabase_table)
        stockdatabase_datas = cur.fetchall()
        
        cur.execute('SELECT * FROM %s;' % lionnote_table)
        lionnote_datas = cur.fetchall()

        stock_number_array = []
        for wadai_data in wadai_datas:
            stock_number_array.append(str(wadai_data[2]))
        
        for topfifiteen_data in topfifiteen_datas:
            for i in range(2, 27):
                if (i == 17 or i == 18):
                    continue
                if (topfifiteen_data[i] == None):
                    null_number = i
                    break
                stock = topfifiteen_data[i]
                stock_number = re.search('\d{4}', stock)
                stock_number = stock_number.group(0)
                stock_number_array.append(stock_number)
                
        for stockchange_data in stockchange_datas:
            for i in range(2,26):
                if (stockchange_data[i] == None):
                    break
                stock = stockchange_data[i]
                stock_number = re.search('\d{4}', stock)
                stock_number = stock_number.group(0)
                stock_number_array.append(stock_number)

        for stockdatabase_data in stockdatabase_datas:
            stock_number_array.append(str(stockdatabase_data[1]))

        for lionnote_data in lionnote_datas:
            stock_number_array.append(str(lionnote_data[4]))

        stock_number_array = list(dict.fromkeys(stock_number_array))

        driver = self.driver

        for stock_number in stock_number_array:
            ifisUrl = 'https://kabuyoho.ifis.co.jp/index.php?action=tp1&sa=report&bcode=' + stock_number
            print(ifisUrl)
            driver.get(ifisUrl)
            driver.set_window_size(638, 878)
            driver.execute_script("window.scrollTo(10, 144);")
            sleep(2)
            driver.save_screenshot('ifis_' + stock_number + '.png')

        sleep(1)
                    
        conn.commit()

        cur.close()
        conn.close()

        driver.quit()

if __name__ == "__main__":
    IfisScraping().main()




