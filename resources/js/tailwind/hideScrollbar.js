import plugin from 'tailwindcss/plugin';

export default plugin(function({ addUtilities }) {
    const newUtilities = {
        '.scrollbar-hidden': {
            '-ms-overflow-style': 'none',
            'scrollbar-width': 'none',
            '&::-webkit-scrollbar': {
                display: 'none',
            },
        }
    }

    addUtilities(newUtilities, ['responsive', 'hover']);
})
