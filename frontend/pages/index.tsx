import { Text, Heading, VStack, KleeRadius, KleeShadow } from '@liinkiing/klee'
import type { NextPage } from 'next'

import AppHead from '~/components/AppHead'
import Page from '~/components/layout/Page'

const Index: NextPage = () => (
  <Page>
    <AppHead title="Homepage" />
    <Heading as="h1">Index Page</Heading>
    <VStack mt={2} gap={4}>
      <Text>Hello from index page</Text>
      <Text
        borderRadius={KleeRadius.Lg}
        p={4}
        boxShadow={KleeShadow.Lg}
        _light={{ bg: 'blue.200' }}
        _dark={{ bg: 'violet.500' }}
      >
        I am blue in light mode and violet in dark mode!
      </Text>
    </VStack>
  </Page>
)

export default Index
