import React from 'react';

import Logo from '../../svg/Logo';
import Footer from '../Footer';

import styles from './Sidebar.module.scss';

const Sidebar = () => (
  <div className={styles.sidebar}>
    <div className={styles.logo}>
      <Logo />
    </div>
  </div>
);

export default Sidebar;
