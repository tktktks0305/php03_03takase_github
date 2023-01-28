<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 自作CSSの読み込み -->
    <link rel="stylesheet" href="./css/layout.css">
    <!-- Font Awesome読み込み -->
    <script src="https://kit.fontawesome.com/f569121d87.js" crossorigin="anonymous"></script>
    <title>ユーザー登録・ログイン</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient fixed-top">
            <div class="container-fluid">
            <a class="navbar-brand" href="index.php">持ち物管理アプリPrototype</a>
            </div>
        </nav>
    </header>
    <div class="container p-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#pane1" data-bs-toggle="tab">ログイン</a> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pane2" data-bs-toggle="tab">ユーザー登録</a> 
            </li>
        </ul>

        <div class="tab-content">
            <div id="pane1" class="tab-pane active">
                <form class="p-4" method="post" action="login_act.php">
                    <div class="mb-3">
                        <label for="exampleDropdownFormEmail2" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleDropdownFormPassword2" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                        <label class="form-check-label" for="dropdownCheck2">
                            Remember me
                        </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </form>
            </div>

            <div id="pane2" class="tab-pane">
                <form class="p-4" method="post" action="./user/user_insert.php">
                    <div class="mb-3">
                        <label for="exampleDropdownFormEmail2" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="exampleDropdownFormPassword2" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">年齢</label>
                            <select name="age" id="age" class="form-select" required>
                                <option value="9歳以下">9歳以下</option>
                                <option value="10代">10代</option>
                                <option value="20代" selected>20代</option>
                                <option value="30代">30代</option>
                                <option value="40代">40代</option>
                                <option value="50代">50代</option>
                                <option value="60歳以上">60歳以上</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">性別</label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="男性">男性</option>
                                <option value="女性" selected>女性</option>
                                <option value="無回答">無回答</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">ユーザー登録</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer container-m">MIL 4th php03_03takase</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

</body>
</html>