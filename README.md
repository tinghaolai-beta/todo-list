# API documentation

## APIS
| 說明 | Method | Path | 參數 |
|---|---|---|---|
| 上傳圖片 | POST  | /image  | file: 上傳圖檔  |
| 新增 todo  | POST  | /todoList  | title: todo 標題, todo 內容  |
| 取得單筆 todo  | GET  | /todoList/:id  | id: todo id  |

## Image

### 上傳圖片
| Method | path  |
|---|---|
| POST  | /image  |

#### 參數說明

* file: 上傳圖檔
    * 必填
    * 接受檔案類型: `jpeg,png,jpg,gif`

#### 回傳值說明

* status: Api 執行結果
    * success: 成功
    * fail: 失敗
* message: 錯誤時的錯誤訊息
    * invalidParams: 參數錯誤
    * sizeError: 檔案大小錯誤
    * uploadFail: 上傳錯誤
* data: 若成功時，此欄位回傳圖片 url


## Todo list

### 新增 Todo

| Method | path |
|---|---|
| POST  | /todoList |

#### 參數說明

* title: todo 標題
    * string
    * 必填
* todoContent todo 內容
    * string
    * 必填

#### 回傳值說明

* status: Api 執行結果
    * success: 成功
    * fail: 失敗
