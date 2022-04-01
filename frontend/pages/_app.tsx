import { KleeProvider, useTheme } from '@liinkiing/klee'
import { AnimatePresence } from 'framer-motion'
import type { AppProps } from 'next/app'
import type { FC } from 'react'

import NProgress from '~/components/NProgress'
import AppNav from '~/components/layout/AppNav'
import GlobalStyles from '~/styles/Global'

const MyApp: FC<AppProps> = ({ Component, pageProps, router }) => {
  const theme = useTheme()

  return (
    <>
      <GlobalStyles />
      <NProgress color={theme.colors.red['400']} spinner={false} />
      <AppNav />
      <AnimatePresence exitBeforeEnter initial={false}>
        <Component {...pageProps} key={router.route} />
      </AnimatePresence>
    </>
  )
}

const MyAppWithProviders = ({ ...props }: AppProps) => (
  <KleeProvider>
    <MyApp {...props} />
  </KleeProvider>
)

export default MyAppWithProviders
