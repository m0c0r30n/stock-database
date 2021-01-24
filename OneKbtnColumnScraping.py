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

class OneColumnScraping():
    def __init__(self):
        options = webdriver.ChromeOptions()
        # options.add_argument('--headless')
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

        kabutan_column_table = 'kabutan_columns'
        kabutan_columns_vs_stocks_table = 'kabutan_columns_vs_stocks'

        #kbtntop
        kbtn_category = 'kbtntop'
        kbtn_url = 'https://selection.kabutan.jp/category/kbtntop/'

        driver = self.driver
        
        driver.get(kbtn_url)

        sleep(2)
        
        a = driver.find_element_by_xpath("//body/div[1]/div/div[1]/div[4]/span[2]/a")
        detail_url = a.get_attribute("href")
        title = a.text

        r = requests.get(detail_url)
        soup = BeautifulSoup(r.content, 'lxml')
        stock_datetime = soup.select_one("time.s_news_date")["datetime"]
        
        stock_date = stock_datetime.split("T")[0]

        date = datetime.datetime.strptime(stock_date, '%Y-%m-%d')
        article = soup.select_one("div.body").text

    
        stock_number_list = re.findall('<\d{4}>', article)

        # cur.execute('insert into kabutan_columns (title, description, category, date) values(%s, %s, %s, %s) ', (str(title), str(article), str(kitahama_category), date))

        if (len(stock_number_list) != 0):
            column_id = cur.lastrowid

            for stock_number in stock_number_list:
                stock_number = stock_number.replace('<', '')
                stock_number = stock_number.replace('>', '')
                print(stock_number)

                # cur.execute('insert into kabutan_columns_vs_stocks (kabutan_column_id, stock_number) values(%s, %s) ', (int(column_id), int(stock_number)))
    
        sleep(2)
                    
        conn.commit()

        cur.close()
        conn.close()

    def __del__(self):
        print("del:driver")
        self.driver.quit()

if __name__ == "__main__":
    OneColumnScraping().main()



