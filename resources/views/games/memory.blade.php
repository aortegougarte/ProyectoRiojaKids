@extends('layouts.app-kids')
@section('title', 'Memoria - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="fw-bold mb-0">🃏 Juego de Memoria</h2>
        <a class="btn btn-outline-primary kids-pill" href="{{ route('games.index') }}">← Volver</a>
    </div>

    <div class="kids-card p-4 mb-3">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
            <div class="rk-fact">🔁 Intentos: <b id="tries">0</b></div>
            <div class="rk-fact">✅ Parejas: <b id="pairs">0</b> / 6</div>
            <button class="btn btn-primary kids-pill" id="restart">Reiniciar</button>
        </div>
    </div>

    <div class="row g-3" id="board"></div>

    <script>
        // Memoria simple (sin librerías)
        const EMOJIS = ['🦁','🐘','🐬','🐸','🦉','🐢'];
        const board = document.getElementById('board');
        const triesEl = document.getElementById('tries');
        const pairsEl = document.getElementById('pairs');
        const restartBtn = document.getElementById('restart');

        let cards = [];
        let flipped = [];
        let lock = false;
        let tries = 0;
        let pairs = 0;

        function shuffle(arr){
            for(let i = arr.length - 1; i > 0; i--){
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        function render(){
            board.innerHTML = '';
            cards.forEach((c, idx) => {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-3 col-lg-2';

                const btn = document.createElement('button');
                btn.className = 'rk-memory-card kids-card w-100 p-0';
                btn.setAttribute('type','button');
                btn.dataset.index = idx;

                btn.innerHTML = `
                    <div class="rk-memory-inner ${c.matched ? 'is-matched' : ''} ${c.open ? 'is-open' : ''}">
                        <div class="rk-memory-face rk-memory-back">❓</div>
                        <div class="rk-memory-face rk-memory-front">${c.emoji}</div>
                    </div>
                `;

                btn.addEventListener('click', () => flip(idx));

                col.appendChild(btn);
                board.appendChild(col);
            });

            triesEl.textContent = tries;
            pairsEl.textContent = pairs;
        }

        function reset(){
            tries = 0; pairs = 0; flipped = []; lock = false;
            const deck = shuffle([...EMOJIS, ...EMOJIS]).map(e => ({emoji:e, open:false, matched:false}));
            cards = deck;
            render();
        }

        function flip(i){
            if(lock) return;
            const card = cards[i];
            if(card.open || card.matched) return;

            card.open = true;
            flipped.push(i);
            render();

            if(flipped.length === 2){
                tries++;
                const [a,b] = flipped;
                const ca = cards[a];
                const cb = cards[b];

                if(ca.emoji === cb.emoji){
                    ca.matched = cb.matched = true;
                    flipped = [];
                    pairs++;
                    render();
                }else{
                    lock = true;
                    setTimeout(() => {
                        ca.open = false;
                        cb.open = false;
                        flipped = [];
                        lock = false;
                        render();
                    }, 700);
                }
            }
        }

        restartBtn.addEventListener('click', reset);
        reset();
    </script>
@endsection
