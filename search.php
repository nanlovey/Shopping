<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shopping</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body background="miao.png" class="background">
<div class="top-wrapper">
    <!-- ここにコードを書いていきましょう -->
    <div class="container">
        <h1 class="header-logo">shopping</h1>
    </div>
    <div class="header">
        <div class="header-list">
            <ul >
                <li class="header-first h-list">購入履歴</li>
                <li class="h-list">お気に入り</li>
                <li class="h-list">マイページ</li>
            </ul>
            <div class="search">
                <input type="text" class="search-text" placeholder="何をお探しですか？">
            </div>
            <input type="submit" value="検索する" >
        </div>
        <div class="btn-pulase">
            <div id="js-after-pulase">
                <button class="pulase js-pulase">➕条件追加</button>
                <div class="signup-modal-wrapper">
                </div>
                <!-- 「login-modal」というidを追加してください -->
                <div class="login-modal-wrapper" id="login-modal">
                    <!-- ログインのモーダル部分のHTMLを貼り付けてください -->
                    <div class="modal">
                        <div id="login-form">
                            <p><a id="modal-close" class="button-link">閉じる</a></p>

                            <form action="#">
                                <tbody>
                                <tr>
                                    <th>キーワード</th>
                                    <td>
                                        <ul>
                                            <li>
                                                    <span>全てを含む
                                                        <input type="text">
                                                    </span>
                                            </li>
                                            <li>
                                                    <span>いずれかを含む
                                                        <input type="text">
                                                    </span>
                                            </li>
                                            <li>
                                                    <span>除外する
                                                        <input type="text">
                                                    </span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>検索範囲</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="radio">
                                                    <span>全て</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="radio">
                                                    <span>商品名のみ</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>カテゴリ</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <label>
                                                        <span>
                                                            <select>
                                                                <?php foreach(getCategoryResult() as $ca){
                                                                    echo '<option >' . $ca['title'].'</option>';
                                                                }
                                                                ?>

                                                            </select>
                                                        </span>
                                                </label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>送料</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>送料無料</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>条件付き送料無料</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>配送</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>当日配送</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>翌日配送</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>配送</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>当日配送</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" >
                                                    <span>翌日配送</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                                確認
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php getModuleResult()?>
            <div class="product">
                <?php
                foreach(getModuleResult() as $va){
                    echo "<div class='product-single'>";
                    echo "<a href='". $va[url]."'>";
                    echo "$va[name] </br>";
                    echo "<img src='".$va['img']."'></br>";
                    echo "</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="body">
        カテゴリ別にみる
        <ul>
            <?php foreach(getCategoryResult() as $ca){
                echo "<a href='". $ca[url]."'>";
                echo '<li class="category">' . $ca['title'].'</li>';
                echo $ca['id'];
                echo "</a>";
            }
            echo "<pre>";
            var_dump(getSearchResult());
            echo "</pre>";
            ?>
        </ul>
    </div>

    <?php

    function getSearchResult() {

        // リクエストURL
        $baseurl = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch"; //XML
        // リクエストのパラメータ作成
        $params = array();
        $params["appid"] = "dj00aiZpPWdiRlhqMzJLQXI0ayZzPWNvbnN1bWVyc2VjcmV0Jng9MDk-"; // アプリケーションID
//        $params["query"] = urlencode_rfc3986($keyword);
        $params['category_id'] = 13457;

        // canonical string を作成
        $canonical_string = "";
        foreach ($params as $k => $v) {
            $canonical_string .= "&" . $k . "=" . $v;
        }
        // 先頭の'&'を除去
        $canonical_string = substr($canonical_string, 1);

        // URL を作成
        $url = $baseurl . "?" . $canonical_string;

        echo $url . "<br>";

        // XMLをオブジェクトに代入
        $yahoo_xml = simplexml_load_string(@file_get_contents($url));

        $items = array();
        foreach($yahoo_xml->Result->Hit as $item){

            $items[] = array(
                'name' => (string)$item->Name,
                'url' => (string)$item->Url,
                'img' => (string)$item->Image->Medium,
                'price' => (string)$item->Price,
            );

        }
        return $items;
    }

    // RFC3986 形式で URL エンコードする関数
    function urlencode_rfc3986($str) {
        return str_replace("%7E", "~", rawurlencode($str));
    }

    function getCategoryResult($keyword) {

        // リクエストURL
        $baseurl = "https://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch"; //XML
        // リクエストのパラメータ作成
        $params = array();
        $params["appid"] = "dj00aiZpPWdiRlhqMzJLQXI0ayZzPWNvbnN1bWVyc2VjcmV0Jng9MDk-"; // アプリケーションID
//        $params["query"] = urlencode_rfc3986($keyword);
        $params["category_id"] = urlencode_rfc3986("1 ");

        // canonical string を作成
        $canonical_string = "";
        foreach ($params as $k => $v) {
            $canonical_string .= "&" . $k . "=" . $v;
        }
        // 先頭の'&'を除去
        $canonical_string = substr($canonical_string, 1);

        // URL を作成
        $url = $baseurl . "?" . $canonical_string;

        // XMLをオブジェクトに代入
        $yahoo_xml = simplexml_load_string(@file_get_contents($url));

        $items = array();

        foreach($yahoo_xml->Result->Categories->Children->Child as $item){
            $items[] = array(
                'id' => (string)$item->Id,
                'url' => (string)$item->Url,
                'title' => (string)$item->Title->Short,
            );

        }
        return $items;
    }

    function getModuleResult() {

        // リクエストURL
        $baseurl = "https://shopping.yahooapis.jp/ShoppingWebService/V1/categoryRanking"; //XML
        // リクエストのパラメータ作成
        $params = array();
        $params["appid"] = "dj00aiZpPWdiRlhqMzJLQXI0ayZzPWNvbnN1bWVyc2VjcmV0Jng9MDk-"; // アプリケーションID
        $params["category_id"] = urlencode_rfc3986("2494");
        $params["gender"] = urlencode_rfc3986("female");
        $params["generation"] = urlencode_rfc3986("20");

        // canonical string を作成
        $canonical_string = "";
        foreach ($params as $k => $v) {
            $canonical_string .= "&" . $k . "=" . $v;
        }
        // 先頭の'&'を除去
        $canonical_string = substr($canonical_string, 1);

        // URL を作成
        $url = $baseurl . "?" . $canonical_string;

        // XMLをオブジェクトに代入
        $yahoo_xml = simplexml_load_string(@file_get_contents($url));

        foreach($yahoo_xml->Result->RankingData as $item){
            $items[] = array(
                'id' => (string)$item->Id,
                'url' => (string)$item->Url,
                'name' => (string)$item->Name,
                'img' => (string)$item->Image->Medium,
            );

        }

        return $items;
    }
    ?>


    </pre>

</div>
<div class="lesson-wrapper">
</div>
<div class="message-wrapper">
</div>
<footer>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="search.js"></script>
</footer>
</body>
</html>