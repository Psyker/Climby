import styled from '@emotion/styled'
import { Box, BoxProps } from '@liinkiing/klee'
import { motion } from 'framer-motion'
import type { NextPage } from 'next'

import { ease } from '~/common/framer'

interface Props extends BoxProps {
  readonly as?: string
  readonly transitionDuration?: number
}

const PageInner = styled(motion(Box))`
  will-change: opacity, transform;
  flex: 1;
  display: flex;
  height: 100%;
  flex-direction: column;
  justify-content: center;
  transform-origin: left center;
  max-width: 90vw;
  margin: 0 auto;
`

const Page: NextPage<Props> = ({ children, as = 'main', transitionDuration = 0.15, ...rest }) => (
  <PageInner
    as={as}
    minWidth={['auto', '70vw']}
    initial={{ opacity: 0, x: -10 }}
    animate={{ opacity: 1, x: 0 }}
    exit={{ opacity: 0, x: -10 }}
    transition={{ duration: transitionDuration, ease }}
    {...rest}
  >
    {children}
  </PageInner>
)

export default Page
