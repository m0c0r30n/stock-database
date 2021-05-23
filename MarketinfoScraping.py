import requests
import MySQLdb
import re
from bs4 import BeautifulSoup
from selenium.webdriver.support.select import Select
from selenium import webdriver
from time import sleep
import datetime
import os

class MarketinfoScraping():
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

        kabutan_column_table = 'market_informations'
        stock_table = 'stocks'
        driver = self.driver

        today = datetime.date.today()

        cur.execute('SELECT * FROM %s;' % stock_table)
        stock_datas = cur.fetchall()

        stock_number_array = []
        for stock_data in stock_datas:
            stock_number_array.append(str(stock_data[0]))

        for stock_number in stock_number_array:
            yonhonne_url = 'https://qcs125.qhit.net/smbc_nikko/qcd_detail/qcs-pc/58eb8a3b226f740885db994daccdd801b4d81f72/board-qcs/detail.html?at=0&ch=0&rf=k&ID=N270222533004&sid=&CD=N92DB7G008b27762743bf50030f253&CD2=N92DB7G008b27762743bf50030f253&QCODE='+stock_number+'&MKTN=T&spHyojiMode=undefined'
            driver.get(yonhonne_url)
            endprice = driver.find_element_by_xpath("//table[@class='price-area']/tbody/tr[1]/td/span").text
            increase_rate = driver.find_element_by_xpath("//table[@class='price-area']/tbody/tr[2]/td[2]/span").text
            openprice = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[1]/td[1]/span").text
            highprice = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[2]/td[1]/span[2]").text
            lowprice = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[3]/td[1]/span[2]").text
            pastprice = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[4]/td[1]/span").text
            dekidaka = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[5]/td[1]/span").text
            tradingprice = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[6]/td[1]/span").text
            vwap = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[7]/td[1]/span").text
            tick = driver.find_element_by_xpath("//table[@class='info-area']/tbody/tr[8]/td[1]/span").text

            nokoriita_over = driver.find_element_by_xpath("//div[@class='qcs-indicates']/div/table/tbody[1]/tr[2]/td[2]/span").text
            nokoriita_under = driver.find_element_by_xpath("//div[@class='qcs-indicates']/div/table/tbody[4]/tr/td[4]/span").text

            market_info_url = 'https://ot3.qhit.net/nikkoc/0000/58eb8a3b226f740885db994daccdd801b4d81f72/contents/quote.cgi?F=shohin/NCdetailquote2&rf=k&ID=N270222533004&SID=&CD=N92DB7G008b27762743bf50030f253&CD2=N92DB7G008b27762743bf50030f253&QCODE='+stock_number+'&MKTN=T&spHyojiMode=undefined%22'
            driver.get(market_info_url)

            yuusizan_sokuho = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[2]/td[1]/span").text
            kasikabuzan_sokuho = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[3]/td[1]/span").text
            kaitennissu = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[5]/th/span").text
            kaitennissu = kaitennissu.split('　')[1]

            onemin_chart_url = 'https://ot3.qhit.net/nikkoc/0000/58eb8a3b226f740885db994daccdd801b4d81f72/contents/quote.cgi?F=hist%2FNCintraday&ch=0&rf=k&ID=N270222533004&sid=&CD=N92DB7G008b27762743bf50030f253&CD2=N92DB7G008b27762743bf50030f253&spHyojiMode=undefined&QCODE='+stock_number+'&MKTN=T'
            driver.get(onemin_chart_url)
            onemin_chart = driver.find_element_by_xpath("//input[@name='histintd']").get_attribute("value")
            
            cur.execute('insert into market_informations (stock_number, date, kaitennissu, date) values(%s, %s, %s, %s) ', (str(title), str(article), str(kitahama_category), date))
            
            sleep(2)
    
        driver.quit()
        conn.commit()

        cur.close()
        conn.close()

if __name__ == "__main__":
    MarketinfoScraping().main()




