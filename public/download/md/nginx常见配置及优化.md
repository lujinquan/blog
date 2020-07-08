下面是一些常见的nignx配置是工作中可能经常用得到的，详细的配置及优化参考 [nginx官方文档](href=&quot;https://www.nginx.cn/doc/&quot;)。


#### 一、nginx反向代理
```
location /upload/{
    #将访问/upload地址指向服务器的/local/file/目录，例如：可以将多个项目的某些公用的文件放在一个位置，同时指向这个地址
    alias /local/file/ ;
}

location /upload/{
    #访问/upload下的文件如果无法找到，则在代理服务器下的/upload下寻找文件
    if (!-e $request_filename){
        proxy_pass   http://10.xxx.xxx.9:8008;
    }
}

```
#### 二、nginx的常见https配置
```
server {
        listen       443;
        server_name  xxx.xxx.com;
        root         /usr/xxx/xxx/xxx;

        ssl on;
        # 注意路径如果是相对路径记得相对当前配置文件
        ssl_certificate   cert/2383461_xxx.xxx.com.pem;
        ssl_certificate_key  cert/2383461_xxx.xxx.com.key;
        ssl_session_timeout 5m;
        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_prefer_server_ciphers on;

        # 设置最大上传大小为20M
        client_max_body_size 20m;
        include /etc/nginx/default.d/*.conf;
        location / {
            index index.html index.htm index.php;
            if (!-e $request_filename){
                rewrite ^(.*)$ /index.php?s=/$1 last;
                break;
            }
        }
        error_page 404 /404.html;
            location = /40x.html {
        }
        error_page 500 502 503 504 /50x.html;
            location = /50x.html {
        }
        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }

    }
```
#### 三、nginx配置301重定向
```
 server {
    listen       80;
    server_name  xxx.xxx.com;
    # 下面的事将80端口访问的xxx.xxx.com重定向到443端口的https://xxx.xxx.com，提示：$server_name可以换成固定的网址
    return   301 https://$server_name$request_uri;
 }
```
#### 四、nginx配置miss访问
```
server {
    # 服务器中80端口未绑定的域名默认访问该位置
    listen 80 default_server;
    server_name  _;
    return 404;
}
```
#### 五、nginx配置跨域访问
```
location ~ .*\.(eot|ttf|ttc|otf|eot|woff|woff2|svg)(.*) {
    # 允许https://xxx.xxx.com跨域访问以上资源
    add_header Access-Control-Allow-Origin https://xxx.xxx.com;
}
```
#### 六、nginx优化配置

```
# 设置 nginx 的工作进程数量（默认值：1）
# 最大为CPU的逻辑处理器数量，比如6核心12线程的CPU，最大设置就是12，如果是6核心6线程，则为6。
# 需要考虑系统资源分配，每多一个运行进程，内存占用都要多一份（比如一个进程为400M，两个就是400M*2=800M）
worker_processes  1;

# 设置 nginx 最大文件描述符打开限制
# 在 Linux 系统中，每建立一个连接都是打开一个文件描述符（作为反向代理或负载均衡连接数量会翻倍，因为内外各一个）
# 所以文件的打开限制决定了 nginx 的最大连接数（应大于 worker_processes * worker_connections）
# 此处配置需要参考系统的限制（ulimit -n），不能超过系统的最大限制
worker_rlimit_nofile 65535;

events {

    # 此为 Linux 系统特为处理大批量文件描述符而作改进的 poll 事件模型
    use epoll;
    # 设置每个工作进程可处理的最大连接数量
    # 此设置将直接影响工作进程的内存固定占用，每个连接大概占用内存 0.4~0.5KB 左右
    # 此值应小于 worker_connections / worker_processes
    worker_connections 65535;
    # 允许同时接受多个网络连接
    multi_accept on;
}

http {
    # 配置文件类型映射，以及默认的 mime 类型
    include       mime.types;
    default_type  application/octet-stream;
    
    # 设置请求头缓冲区大小，超过后会使用下面的配置大小
    # client_header_buffer_size 1K
    # 设置更大的请求头缓冲区大小，如果请求头超出可能会返回 HTTP 414
    # large_client_header_buffers 8K
    
    # 设置请求体缓冲区大小，大于此缓冲区大小的，将写入磁盘文件
    # client_body_buffer_size 16K
    # 设置请求体最大大小（此项影响上传文件的最大大小）
    client_max_body_size 1000m;

    # 提供了一种减少拷贝次数，提升文件传输性能的方法。（静态文件由内核直接发送给 socket，而不是由进程读取到内存再发送）
    sendfile        on;
    
    # 降低数据包发送频率，当数据包满时再发送，减少网络数据包数量，降低网络拥塞情况，仅在 sendfile on 时生效
    tcp_nopush     on;
    
    # 为 http 请求保持 tcp 连接，避免短时间内多次 http 请求反复三次握手来建立 tcp 连接
    # 配置保持连接的数量（默认值：100）
    keepalive_requests 100;
    # 配置保持连接的时长
    keepalive_timeout  10;

    gzip on;                        # 开启 gzip，会增加对 cpu 的资源消耗
    gzip_min_length 1k;                # 低于 1kb 的资源不压缩
    gzip_comp_level 2;                # 压缩级别 1-9，越大压缩率越高，同时消耗 cpu 资源也越多。
    # 需要压缩哪些响应类型的资源，多个空格隔开。有些格式的文件压缩效率较低，不建议压缩。
    gzip_types text/plain application/json application/javascript application/x-javascript text/javascript text/xml text/css;
    gzip_disable &quot;MSIE [1-6]\.&quot;;    # 配置禁用 gzip 条件，支持正则。此处表示 ie6 及以下不启用 gzip（因为 ie 低版本不支持）
    gzip_vary on;                    # 配置添加 Vary 响应头
    
    # 暂不知道用途，主要用来解决：could not build the proxy_headers_hash 错误
    proxy_headers_hash_max_size 51200;
    proxy_headers_hash_bucket_size 6400;

    server {
        listen       80;
        
        server_name  demo.psy-cloud.com;

        location * {
            return 404;
        }
    }
}
```