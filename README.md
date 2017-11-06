# 如何部署？
复制一份`.env.example`重命名为`.env`,然后配置好数据库连接

# 安装BCMath扩展
```
sudo apt-get install php7.0-bcmath
```

# 生成数据结构
```
php artisan migrate
```

# 数据填充
```
php artisan db:seed
```

# 创建公共目录软链接
```
php artisan storage:link
```

# 后台访问
```
http://www.host.com/index.php/admin/login
```