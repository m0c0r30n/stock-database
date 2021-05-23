import requests
import MySQLdb
import re
from bs4 import BeautifulSoup
from selenium.webdriver.support.select import Select
from selenium import webdriver
from time import sleep
import datetime
import os

class StockdataScraping():
    def __init__(self):
        options = webdriver.ChromeOptions()
        options.add_argument('--headless')
        self.driver = webdriver.Chrome(options=options)

    def main(self):
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

        kabutan_column_table = 'stocks'
        driver = self.driver

        first_code = 1000

        base_stock_url = 'http://kabureal.net/brandlist/?code='

        while first_code < 10000:
            stock_url = 'http://kabureal.net/brandlist/?code=' + str(first_code)
            driver.get(stock_url)

            sleep(2)
            
            stockinfo = driver.find_elements_by_xpath("//div[@class='span4']")
            stockinfo = stockinfo[:-1]
          
            for stocks in stockinfo:
                try:

                    stock = stocks.find_element_by_tag_name("a").text
                    stock_category = stocks.find_element_by_tag_name("div").text

                    stock = stock.split(' ')
                    stock_category = stock_category.split('　')
                    code = stock[0]
                    name = stock[1]
                    market = stock_category[0]
                    category = stock_category[1]
                    print(code)

                    cur.execute('insert into stocks (code, name, market, category) values(%s, %s, %s, %s) ', (int(code), str(name), str(market), str(category)))

                except:
                    continue
            first_code += 500
    
        driver.quit()
        conn.commit()

        cur.close()
        conn.close()

if __name__ == "__main__":
    StockdataScraping().main()




