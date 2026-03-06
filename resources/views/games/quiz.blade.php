@extends('layouts.app-kids')
@section('title', 'Mini-Quiz - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="fw-bold mb-0">🧠 Mini-Quiz</h2>
        <a class="btn btn-outline-primary kids-pill" href="{{ route('games.index') }}">← Volver</a>
    </div>

    <div class="kids-card p-4 rk-quiz" id="quizCard">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="rk-fact">⭐ Puntos: <b id="score">0</b></div>
            <button class="btn btn-primary kids-pill" id="newQ">Nueva pregunta</button>
        </div>

        <h4 class="fw-bold mb-3" id="question">Cargando...</h4>

        <div class="d-grid gap-2" id="answers"></div>

        <div class="mt-3" id="feedback"></div>
    </div>

    <script>
        const questions = [
            {
                q: '¿Cuál de estos animales vive en el mar? 🌊',
                a: ['🐬 Delfín','🦁 León','🦉 Búho'],
                ok: 0
            },
            {
                q: '¿Cuál es un reptil? 🦎',
                a: ['🐢 Tortuga','🐸 Rana','🦅 Águila'],
                ok: 0
            },
            {
                q: '¿Qué animal suele volar? ✈️',
                a: ['🦉 Búho','🐟 Pez','🐘 Elefante'],
                ok: 0
            },
            {
                q: '¿Cuál es un anfibio? 🐸',
                a: ['🐸 Rana','🦁 León','🐢 Tortuga'],
                ok: 0
            },
            {
                q: '¿Cuál es un mamífero? 🐾',
                a: ['🐘 Elefante','🐟 Pez','🐸 Rana'],
                ok: 0
            },
        ];

        const qEl = document.getElementById('question');
        const answersEl = document.getElementById('answers');
        const feedbackEl = document.getElementById('feedback');
        const scoreEl = document.getElementById('score');
        const newBtn = document.getElementById('newQ');

        let score = 0;
        let current = null;

        function pick(){
            feedbackEl.innerHTML = '';
            const idx = Math.floor(Math.random() * questions.length);
            current = questions[idx];
            qEl.textContent = current.q;
            answersEl.innerHTML = '';

            current.a.forEach((txt, i) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-outline-primary kids-pill';
                btn.textContent = txt;
                btn.addEventListener('click', () => answer(i));
                answersEl.appendChild(btn);
            });
        }

        function answer(i){
            if(!current) return;
            const ok = i === current.ok;
            if(ok){
                score += 10;
                feedbackEl.innerHTML = '<div class="alert alert-success kids-card p-3 mb-0">¡Correcto! 🎉 +10 puntos</div>';
            }else{
                feedbackEl.innerHTML = '<div class="alert alert-warning kids-card p-3 mb-0">Casi 😅 ¡Prueba otra vez!</div>';
            }
            scoreEl.textContent = score;
        }

        newBtn.addEventListener('click', pick);
        pick();
    </script>
@endsection
