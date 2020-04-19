<b<body>
  <div class="container">
  <!--<link rel="stylesheet" href="<?php echo base_url('./assets/css/style.css') ?>"> -->
  <?php echo "<body style='background-color:#222222'>"; ?>
    <div class="jumbotron">
      <div class="row">
        <input type="text" class="form-control" id="searchtxt" placeholder="Search Items..." name="searchTest">
        <select class="type-filter" id=searchType>
          <option selected="selected" value="0">Everything</option>
          <option value="1">Book</option>
          <option value="2">Audio Book</option>
          <option value="3">Film</option>
        </select>
        <select class="title-filter" id="searchTitle">
          <option selected="selected" value="title">Title</option>
          <option value="author">Author</option>
          <option value="distributor">Distributor</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-warning" type="button">Search</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="items-container">
    <div id="items"></div>
  </div>
  </body>
