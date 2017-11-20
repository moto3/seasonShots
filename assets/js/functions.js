
function setToday(){
  dt = new Date();
  $("input[name=showDate]").val(dt.getFullYear() + "/" + padNumber(dt.getMonth() + 1) + "/" + padNumber(dt.getDate()));
}

function loadFiles(){
  $.ajax({
    type: "GET",
    url: "loadPhotos.php",
    cache: false,
    success: function(data){
      init(data);
    }, dataType: 'json'
  });
}

function init(arg_data){
  fileList = arg_data;
  if (fileList.length > 0){
    document.getElementById('timeStamp').innerHTML = "指定の撮影データが" + fileList.length + "枚あります";
  } else {
    document.getElementById('timeStamp').innerHTML = "指定の撮影データはありません";
  }
  $("#slider-gauge span.start").html(fileList[0].dateString);
  $("#slider-gauge span.end").html(fileList[fileList.length-1].dateString);

  for(i = 0; i < sliderPadding; i++){
    fileList.unshift(null);
    fileList.push(null);
  }
  $("#slider").slider( "option", "max", fileList.length );
  $("#slider").slider("values",0,0).slider("values",1,fileList.length).slider("values",2,sliderPadding);
  currentFrame = sliderPadding;
  setSliderRange();

  setToday();
  $("#button_start").click(togglePlay);
}

function renderFrame() {
  console.log(sliderPadding)
  $("#timeStamp").html(fileList[currentFrame].dateString);
  $("#imageArea").attr('src', dir + fileList[currentFrame].fileName);
}


/* - - -  S L I D E  S H O W  C O N T R O L  - - - */
function togglePlay(){
  if (!playing){
    startSlideShow();
    playing = true;
  }else{
    stopSlideShow();
    playing = false;
  }
}
function startSlideShow() {
  $("#button_start").addClass("stop");
  runSlideShow();
}
function runSlideShow() {
  currentFrame++;
  if(fileList.length - sliderPadding <= currentFrame){
    console.log('end')
    currentFrame = sliderPadding;
  }
  $("#slider").slider( "values", 2, currentFrame );
  renderFrame();
  slideShowInterval = setTimeout("runSlideShow()", intTime);
}
function stopSlideShow() {
  $("#button_start").removeClass("stop");
  clearTimeout(slideShowInterval);
}

/* - - -  S L I D E R  S T U F F  - - - */
function setSliderRange(arg_values){
  var min = $("#slider").slider("values",0);
  var diff = $("#slider").slider("values",1) - $("#slider").slider("values",0);
  var max = $("#slider").slider("option","max");
  $("#custom-range").css({
    'left': Math.floor(min / max * 100) + "%",
    'width': (diff / max * 100) + "%"
  });
}

/* - - -  U T I L I T Y  - - - */
function padNumber(arg_num){
  if (arg_num < 10) { 
    return "0" + arg_num;
  }else{
    return arg_num;
  }
}
