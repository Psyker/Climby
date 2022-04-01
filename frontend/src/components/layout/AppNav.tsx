import { HStack, klee } from '@liinkiing/klee'
import type { FC } from 'react'

import AppLink from '~/components/AppLink'
import SchemeToggler from '~/components/SchemeToggler'

const AppNav: FC = () => (
  <klee.nav p={8}>
    <HStack as="ul" align="center" sx={{ listStyle: 'none' }} gap={2}>
      <klee.li>
        <AppLink href="/">Home</AppLink>
      </klee.li>
      <klee.li>
        <AppLink href="/about">About</AppLink>
      </klee.li>
      <klee.li ml="auto">
        <SchemeToggler />
      </klee.li>
    </HStack>
  </klee.nav>
)

export default AppNav
