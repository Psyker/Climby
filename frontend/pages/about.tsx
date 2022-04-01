import { klee, Heading, Text } from '@liinkiing/klee'
import type { NextPage } from 'next'

import AppHead from '~/components/AppHead'
import Page from '~/components/layout/Page'

const About: NextPage = () => (
  <Page>
    <AppHead title="About" />
    <Heading as="h1">About Page</Heading>
    <klee.div mt={2}>
      <Text>Hello from about page</Text>
    </klee.div>
  </Page>
)

export default About
