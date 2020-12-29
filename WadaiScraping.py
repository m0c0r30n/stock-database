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

class WadaiScraping():
    def __init__(self):
        self.wadaiurl = "https://kabutan.jp/news/marketnews/?category=9"

        options = webdriver.ChromeOptions()
        # options.add_argument('--headless')
        self.driver = webdriver.Chrome(options=options)

    def main(self):
        conn = MySQLdb.connect(
            host='localhost',
            port=3306,
            user='root',
            password='',
            database='stock_databases'
        )
        
        cur = conn.cursor()

        table = 'wadai_data'

        driver = self.driver

        driver.get(self.wadaiurl)

        page = '&page=1'

        select = Select(driver.find_element_by_xpath("//select[@name='pagecount']"))
        select.select_by_index(2)

        sleep(5)

        for page in range(1, 7):
            wadaikabu_list = driver.find_elements_by_xpath("//div[@class='news_contents']/table/tbody/tr/td[3]/a[contains(text(), '話題株ピックアップ【夕刊】')]")

            for a in wadaikabu_list:
                detail_url = a.get_attribute("href")

                r = requests.get(detail_url)
                soup = BeautifulSoup(r.content, 'lxml')
                stock_datetime = soup.select_one("time.s_news_date")["datetime"]
                
                stock_date = stock_datetime.split("T")[0]
                print(type(stock_date))
                stock_date = datetime.datetime.strptime(stock_date, '%Y-%m-%d')
                print(type(stock_date))
                article = soup.select_one("div.body").text
                stock_list = article.split('■')[1:]
        
                for stock in stock_list:
                    stock_number = re.search('\d{4}', stock)
                    stock_number = stock_number.group(0)
                    stock_name = stock.split('<')[0]
                    if ('●' in stock):
                        stock_description = stock.split('●')[0]
                    elif ('株探ニュース' in stock):
                        stock_description = stock.split('株探ニュース')[0]
                    else:
                        stock_description = stock
                    
                    print(datetime)
                    print(stock_number)
                    print(stock_name)
                    print(stock_description)
                    cur.execute('insert into wadai_data (stock_number, stock_name, stock_description, date) values(%s, %s, %s, %s) ', (str(stock_number), str(stock_name), str(stock_description), stock_date))
        
            driver.find_element_by_xpath("//div[@class='pagination']/ul/li[6]").click()

        sleep(5)
                    
        conn.commit()

        cur.close()
        conn.close()

    def __del__(self):
        print("del:driver")
        self.driver.quit()

if __name__ == "__main__":
    WadaiScraping().main()




