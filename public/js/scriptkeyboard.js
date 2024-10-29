document.addEventListener('DOMContentLoaded', () => {
    const KEYS = [
        'ض', 'ص', 'ق', 'ف', 'غ', 'ع', 'ه', 'خ', 'ح', 'ج',
        'ش', 'س', 'ي', 'ب', 'ل', 'ا', 'ت', 'ن', 'م', 'ك',
        'ظ', 'ط', 'ذ', 'د', 'ز', 'ر', 'و', 'ة', 'ث', 'ى',
        'Clear', '!', '.', 'ئ', 'ء', 'ؤ', 'لا', '،', '؟', 'Delete'
    ];

    const NUMERALS = [
        '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '٠'
    ];

    const SPECIAL_KEYS = ['Space'];

    const screen = document.getElementById('screen');
    const keysContainer = document.getElementById('keys');
    const numbersContainer = document.getElementById('numbers');
    const specialContainer = document.getElementById('sp');

    function addLetter(letter) {
        if (letter === 'Clear') {
            screen.value = '';
        } else if (letter === 'Delete') {
            screen.value = screen.value.slice(0, -1);
        } else if (letter === 'Space') {
            screen.value += ' ';
        } else {
            screen.value += letter;
        }
    }

    function createButton(letter) {
        const button = document.createElement('button');
        button.textContent = letter;
        button.classList.add('key-button');
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default action
            addLetter(letter);
        });
        return button;
    }

    NUMERALS.forEach(num => {
        const button = createButton(num);
        button.id = 'nums';
        numbersContainer.appendChild(button);
    });

    KEYS.forEach(key => {
        const button = createButton(key);
        button.id = 'key';
        keysContainer.appendChild(button);
    });

    SPECIAL_KEYS.forEach(special => {
        const button = createButton(special);
        button.id = 'special';
        specialContainer.appendChild(button);
    });
});
