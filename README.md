# Lumen Validator

## 关于
Lumen Validator 提供了一种类似与Laravel FormRequest 的请求验证器，使请求校验更方便。

Lumen 原有的校验方式：
```php
    <?php
   use Illuminate\Http\Request;
   class IndexController
   {
        public function index(Request $request){
            $rules = $messages = $attributes = [];
            // 校验
            $this->validate($request, $rules, $messages, $attributes);
        } 
    }
```

Lumen Validator 提供的方式：

- Laravel FromRequest 的方式
```php
    <?php 
    use \GeXingW\LumenValidator\Request\ValidatorRequest;
    
    class IndexRequest extends ValidatorRequest{
        // Rules
        protected function _rules()
        {
            $rules = [];
            return $rules;
        }
        
        // Messages
        protected function _messages()
        {
            $messages = [];
            return $messages;
        }
        
        // Attributes
        protected function _attributes()
        {
            $_attributes = [];
            return $_attributes;
        }
        
    }
```
```php

    // Contorller
    <?php
    
    class IndexController
    {
        public function index(IndexRequest $request)    // 依赖注入的方式
        {
            return 'Index controller';
        }
    }
```
- 非依赖注入的方式可以考虑继续使用官方提供的方法

## 安装
- Composer 安装
    ```
    composer require gexingw/lumen-request-validator
    ```
- 下载安装，下载解压缩即可

## 配置

- 将如下代码加入到 `bootstrap/app.php`
```php
<?php
$app->register(\GeXingW\LumenValidator\RequestValidatorProvider::class);
```
