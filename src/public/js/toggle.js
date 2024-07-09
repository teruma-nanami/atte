document.addEventListener('DOMContentLoaded', function() {
  const startButton = document.getElementById('start');
  const endButton = document.getElementById('end');

  // ページ読み込み時にボタンの状態を設定
  if (localStorage.getItem('workStarted') === 'true') {
    startButton.disabled = true;
    endButton.disabled = false;
  } else {
    startButton.disabled = false;
    endButton.disabled = true;
  }

  startButton.addEventListener('click', function() {
    localStorage.setItem('workStarted', 'true');
  });

  endButton.addEventListener('click', function() {
    localStorage.removeItem('workStarted');
    localStorage.removeItem('breakStarted');
  });

  const breakStartButton = document.getElementById('breakStart');
  const breakEndButton = document.getElementById('breakEnd');


  // ページ読み込み時にボタンの状態を設定
  if (localStorage.getItem('breakStarted') === 'true') {
    breakStartButton.disabled = true;
    breakEndButton.disabled = false;
  } else {
    breakStartButton.disabled = false;
    breakEndButton.disabled = true;
  }

  breakStartButton.addEventListener('click', function() {
    localStorage.setItem('breakStarted', 'true');
  });

  breakEndButton.addEventListener('click', function() {
    localStorage.removeItem('breakStarted');
  });
});