import requests
import unittest

class TestPostClientsMethods(unittest.TestCase):

    def setUp(self):
        self.url = 'http://localhost:8888/clients'
        self.json = { 'clients' : [ '192.168.2.1', '192.168.2.2' ] }

    def test_post(self):
        returned = requests.post(self.url, json=self.json)
        self.assertEqual(returned.status_code, 200)

    def test_get(self):
        returned = requests.post(self.url)
        self.assertEqual(returned.status_code, 404)

if __name__ == '__main__':
    unittest.main()
