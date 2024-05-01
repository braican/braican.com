import React from 'react';
import PropTypes from 'prop-types';

import Sidebar from '../../components/Sidebar';
import Footer from '../../components/Footer';

import styles from './Base.module.scss';

// Import global styles.
import '../../styles/globals.scss';

const BaseLayout = ({ children, headline }) => (
  <div className={styles.layout}>
    <div
      dangerouslySetInnerHTML={{
        __html:
          '<noscript><style>.main-content {opacity: 1 !important; transform: translate3d(0, 0, 0) !important;} .site-footer {opacity: 1 !important;}</style></noscript>',
      }}
    />

    <Sidebar />

    <main className={`${styles.layout__main} main-content`}>
      {headline && <h1 className={`headline ${styles.headline}`}>{headline}</h1>}

      <div className={styles.body}>{children}</div>

      {/* <Footer className={styles.mobileFooter} /> */}

      <Footer className={`${styles.footer} site-footer`} />
    </main>
  </div>
);

BaseLayout.propTypes = {
  children: PropTypes.node.isRequired,
  headline: PropTypes.string,
};

export default BaseLayout;
