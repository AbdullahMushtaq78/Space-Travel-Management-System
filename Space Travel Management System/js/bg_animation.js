let colors = [
    '#74b9ff',
    '#ff7675',
    '#fd79a8',
    '#fdcb6e',
    '#55efc4',
    '#fd9644'
]

function createElement(){
    let container = document.querySelector('.animcontainer');
    let span = document.createElement('span');

    var size = Math.random()*50;
    let bg = colors[Math.floor(Math.random()*colors.length)];
    span.style.height = 50 + size + 'px';
    span.style.width = 50 + size + 'px';
    span.style.top = Math.random() * innerHeight + 'px';
    span.style.left = Math.random() * innerWidth + 'px';
    span.style.background = bg;

    container.appendChild(span);
    setTimeout(() => {
       span.remove() 
    }, 5000);
}

setInterval(createElement, 100);