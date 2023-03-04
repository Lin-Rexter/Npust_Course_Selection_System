# -*- coding: utf-8 -*-
import os
import sys
import requests
import json
import re
import time
import traceback # 輸出詳細錯誤信息
import pymysql.cursors
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import Select
from bs4 import BeautifulSoup
#from rich.prompt import Prompt
from prompt_toolkit import prompt
from prompt_toolkit.shortcuts import message_dialog
from prompt_toolkit.shortcuts import input_dialog
from prompt_toolkit.shortcuts import yes_no_dialog
#from pprint import pprint
#from bs4 import BeautifulSoup
#from .user_agent import UA
#from urllib.parse import urljoin # 解析相對網址

#name = Prompt.ask("Enter your name", choices=["Paul", "Jessica", "Duncan"], default="Paul")

os.system("mode con cols=135 lines=45")

exit = 0
while(exit!=1):
    os.system("cls")
    req_num = input_dialog(
        title='輸入提示',
        text='請輸入所需資料數量(請輸入正確): ').run()
    if(req_num.isdigit()):
        exit = 1
    else:
        message_dialog(
            title='錯誤提示',
            text='請輸入正確數字!').run()

req_num = int(req_num)

print("\n爬取資料中...\n")

print("===========================================================")

options = Options()
options.add_argument("--headless") # 隱藏視窗
options.add_argument("--disable-notifications")

chrome = webdriver.Chrome('./chromedriver', chrome_options=options)
chrome.get("https://course.npust.edu.tw/Cnc/")

button = chrome.find_element("xpath", "//input[@name='BtnGuest']")
button.click()

chrome.get('https://course.npust.edu.tw/Cnc/Reports/QueryCourseforStud')

select = Select(chrome.find_element("name", "ctl00$MainContent$DropDownListTerm"))
select.select_by_value("1")

button_2 = chrome.find_element("xpath", "//input[@name='ctl00$MainContent$Btnok']")
button_2.click()

def switch_page():
    button_3 = chrome.find_element("xpath", "//input[@name='ctl00$MainContent$Btnok']")
    button_3.click()

soup = BeautifulSoup(chrome.page_source, 'lxml')

table = soup.select("table[style='color:#333333;border-style:Double;font-size: small'] tbody tr")

print("\n=================[ 可取得的資料總數: {} ]=================".format(len(table)-1))

def dict_add(name, key, values):
    name.setdefault(key, []).append(values) # 使用setdefault優點，自動新增預設值

number_dict = {
    1: '開課系所',
    4: '授課教師',
    5: '課程代碼',
    6: '課程名稱',
    8: '開停狀態',
    9: '班級',
    12: '學分',
    13: '修別',
    14: '上課時數',
    15: '星期',
    16: '節次',
    17: '教室'
}

rows = {} 

for row in table:
    # 跳過標體並取10筆課堂資料
    if(0 < table.index(row) < (req_num + 1)):
        for col in row:
            if(row.index(col) in number_dict.keys()):
                #print(col.string)
                dict_add(rows, table.index(row), col.string)

for key, values in rows.items():
    print("{}: {}".format(key, values))

print("\n爬取完成!")

print("\n===========================================================\n")

time.sleep(4)

result = yes_no_dialog(
    title='提示',
    text='是否將爬取的資料存入資料表(course)中?').run()

if(result):
    username = input_dialog(
    title='輸入提示',
    text='請輸入資料庫帳號名稱: ').run()

    password = input_dialog(
        title='輸入提示',
        text='請輸入資料庫帳號密碼: ').run()
    try:
        connection = pymysql.connect(
                            host='localhost',
                            port=3306,
                            user=username,
                            password=password,
                            database='npust_course_selection_system',
                            charset='utf8',
                            cursorclass=pymysql.cursors.DictCursor
                        )

        with connection:
            with connection.cursor() as cursor:
                sql = "INSERT INTO `course` (`department`, `teacher`, `course_id`, `course_name`, `course_status`, `class_name`, `credit`, `subject`, `course_hours`, `day_of_week`, `period`, `class_id`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
                for key, values in rows.items():
                    cursor.execute(sql, (values[0], values[1], values[2], values[3], values[4], values[5], values[6], values[7], values[8], values[9], values[10], values[11]))
            connection.commit()
    
        print("已存入完畢!\n")
        os.system("pause")
        sys.exit(0)
    except Exception as e:
        traceback.print_exc()
else:
    print("已取消存入!\n")
    os.system("pause")
    sys.exit(0)


'''
    with connection.cursor() as cursor:
        # Read a single record
        sql = "SELECT `id`, `password` FROM `users` WHERE `email`=%s"
        cursor.execute(sql, ('webmaster@python.org',))
        result = cursor.fetchall()
        print(result)
'''
