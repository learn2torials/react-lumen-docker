import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

const title = 'React with Webpack and Babel 12';

ReactDOM.render(
    <App title={title} />,
    document.getElementById('root')
);

module.hot.accept();
