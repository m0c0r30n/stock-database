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
        options.add_argument('--headless')
        options.add_argument('--no-sandbox')
        options.add_argument('--disable-gpu')
        options.add_argument('--lang=ja-JP')
        options.add_argument('user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36')
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
        cnt = 0

        stock_number_array = []
        for stock_data in stock_datas:
            stock_number_array.append(str(stock_data[0]))

        for stock_number in stock_number_array:
            try:  
                yonhonne_url = 'https://qcs125.qhit.net/smbc_nikko/qcd_detail/qcs-pc/f93575567c763a5905b02a82e8cd8dca2d93a363/board-qcs/detail.html?at=0&ch=0&rf=k&QCODE='+stock_number+'&MKTN=T&spHyojiMode=undefined'
                driver.get(yonhonne_url)
                sleep(1)
                endprice = driver.find_element_by_xpath("//table[@class='price-area']/tbody/tr[1]/td/span").text
                print(stock_number + " : " +endprice)
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

                market_info_url = 'https://ot3.qhit.net/nikkoc/0000/f93575567c763a5905b02a82e8cd8dca2d93a363/contents/quote.cgi?F=shohin/NCdetailquote2&rf=k&QCODE='+stock_number+'&MKTN=T&spHyojiMode=undefined%22'
                driver.get(market_info_url)

                yuusizan_sokuho = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[2]/td[1]/span").text
                kasikabuzan_sokuho = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[3]/td[1]/span").text
                kaitennissu = driver.find_element_by_xpath("//body/div/div[2]/table/tbody/tr[2]/td/table/tbody/tr/td[3]/div[2]/table/tbody/tr[5]/th/span").text
                kaitennissu = kaitennissu.split('　')[1]

                onemin_chart_url = 'https://ot3.qhit.net/nikkoc/0000/f93575567c763a5905b02a82e8cd8dca2d93a363/contents/quote.cgi?F=hist%2FNCintraday&ch=0&rf=k&spHyojiMode=undefined&QCODE='+stock_number+'&MKTN=T'
                driver.get(onemin_chart_url)
                onemin_chart = driver.find_element_by_xpath("//input[@name='histintd']").get_attribute("value")
                
                cur.execute('insert into market_informations (stock_number, date, kaitennissu, pastprice, openprice, endprice, highprice, lowprice, tradingprice, increase_rate, onemin_chart, yuusizan_sokuho, kasikabuzan_sokuho, nokoriita_over, nokoriita_under, dekidaka, vwap, tick) values(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) ', (int(stock_number), today, str(kaitennissu), str(pastprice), str(openprice), str(endprice), str(highprice), str(lowprice), str(tradingprice), str(increase_rate), str(onemin_chart), str(yuusizan_sokuho), str(kasikabuzan_sokuho), str(nokoriita_over), str(nokoriita_under), str(dekidaka), str(vwap), str(tick)))
                conn.commit()
                sleep(1)
            except Exception as e:
                print("error")

        driver.quit()
        cur.close()
        conn.close()

if __name__ == "__main__":
    MarketinfoScraping().main()




